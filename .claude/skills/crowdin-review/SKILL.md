---
name: crowdin-review
description: Review Crowdin strings that are translated but not yet approved (all languages, or one language code passed as an argument), and check each for translation accuracy, preserved HTML/ICU-style markup like <0></0> and <0/>, preserved Laravel :placeholder variables, and non-empty/non-gibberish content. Use when the user wants to audit, verify, or QA pending Crowdin translations before approval.
---

# Crowdin translation review

Audits Crowdin strings that are **translated but not approved**, and flags ones that
look wrong before a human approves them. Read-only by default — approving or
commenting are separate, confirmed steps at the end.

## Project

- Crowdin project ID: `750053` (identifier `sledgehammertime`), from `.env`
  `CROWDIN_PROJECT_ID` / `CROWDIN_PROJECT_IDENTIFIER`. Use these unless the user
  specifies a different project.
- Source (original) language is English. Translation files live under `/lang/<code>/*.php`
  per `crowdin.yml`.

## Discord role mentions

The project has a Discord server with a translator role per language, and a Crowdin ->
Discord integration that posts new string comments into Discord. Prepending a role mention
in Discord's `<@&ROLE_ID>` format to a comment's text pings that language's translators
when the integration relays it.

Language -> Discord role ID map (fill in as roles are created; a language with no entry
here has no role yet — post the comment without a mention prefix for it, don't guess or
invent an ID):

| Crowdin language | Discord role ID |
|---|---|
| ar | |
| bg | |
| ca | |
| cs | |
| da | |
| de | |
| el | |
| en-GB | |
| eo | |
| es-ES | |
| fa | |
| fi | |
| fr | |
| he | |
| hi | |
| hr | |
| hu | |
| id | |
| it | |
| ja | |
| ko | |
| lt | |
| lv | |
| mn | |
| ms | |
| nb | |
| nl | |
| pl | |
| pt-BR | |
| pt-PT | |
| ro | |
| ru | |
| sr-CS | |
| sv-SE | |
| th | |
| tr | |
| uk | |
| ur-PK | |
| vi | |
| zh-CN | |
| zh-TW | |

(this list is the project's target languages as of 2026-09-09 — if a language is added or
removed from the Crowdin project later, this table will drift; re-check against
`get_project_progress` if a run reports an unfamiliar language code.)

When posting a flagged-string comment in step 5, if the target language has a row in this
table, prefix the comment text with `<@&ROLE_ID> ` before the explanation. Do not do this
for languages missing from the table.

Note: this depends on Crowdin's Discord integration relaying comment text verbatim (or at
least not escaping `<@&...>`) and on the Discord webhook/bot actually being allowed to
mention that role (`allowed_mentions` on the Discord side). Neither has been verified yet —
if the user reports the role isn't actually getting pinged in Discord after a comment is
posted, that's the first thing to check, not the mention syntax itself.

## Arguments

The skill may be invoked with an optional language code, e.g. `/crowdin-review de` or
`/crowdin-review` (all target languages). Accept either a Crowdin language code or a
common name ("German" -> resolve to its Crowdin code via the project's target languages).

## 0. Discover the actual Crowdin MCP tools

Tool names/params on the Crowdin MCP server can change. Do not hardcode calls blindly — at
the start of each run, use `ToolSearch` (e.g. `select:mcp__crowdin__list_language_translations,mcp__crowdin__get_string,...`
or a keyword query like `"crowdin"`) to load the tools below before calling them. If no
Crowdin tools are found, tell the user the `crowdin` MCP server isn't loaded in this session
(needs a Claude Code restart after `claude mcp add`/config change) and stop.

**Required `crowdin-tool-sets`** (set when the server was registered via `claude mcp add
... -H "crowdin-tool-sets: ..."`): `string_translations,tasks,translation_status,string_comments,source_strings`.
`source_strings` is easy to forget but required — without it there is no tool to fetch the
original English text, and the accuracy check is impossible. If a call to `get_string`/
`list_strings` is missing from the discovered tools, tell the user to add `source_strings`
to the `crowdin-tool-sets` header (remove + re-add the server, then restart) and stop.

**The `crowdin-tool-sets` header alone is not enough — the underlying Personal Access
Token needs matching scopes too.** The MCP header only controls which *tools* are exposed;
Crowdin's API still enforces whatever scopes the PAT itself was granted at creation.
Confirmed in testing: `add_approval` worked fine with the original PAT, but every
`add_string_comment` call failed with `403 Forbidden — "Endpoint isn't allowed for token
scopes."` even though `string_comments` was in the tool-sets header. Crowdin's PAT creation
UI has no scope literally named "String Comments" — the scopes are named after API
categories, not tool sets. Confirmed working: **"Source files & strings"** (plus
"Translations", "Translation status", "Tasks", and "Projects (List, Get, Create, Edit)" for
the rest of this skill) covers `add_string_comment` successfully. If step 5's
comment-posting 403s, tell the user to regenerate their PAT (Account Settings → API →
Personal Access Tokens) with at least "Source files & strings" + "Translations" enabled,
then `claude mcp remove crowdin` + re-add + restart — this is a token-scope problem, not a
tool-set header problem, so don't try to fix it by editing the header alone.

**`add_string_comment` with `type: "issue"` and `issueType: "translation_mistake"` is
better than a plain comment** for flagging problems — it shows up with an unresolved-issue
status rather than a passive comment, and takes an optional `targetLanguageId` to scope the
issue to the specific language. Prefer this over `type: "comment"` for step 5's flagged
strings.

Confirmed working tools/calls (see "Known API details" below for the exact parameters that
worked in testing):
- `mcp__crowdin__list_language_translations` — list translations for one target language,
  with a `croql` filter to scope to translated-but-unapproved.
- `mcp__crowdin__get_string` — fetch one source string by `stringId` (text, `context`,
  `hasPlurals`, etc.).
- `mcp__crowdin__get_project_progress` — per-language translated/approved word & phrase
  counts; useful to sanity-check the candidate count you get back, and to skip languages
  with zero gap (`translationProgress == approvalProgress`).
- `mcp__crowdin__add_approval` — approve a translation.
- `mcp__crowdin__add_string_comment` — comment on a string for translators to see.

## 1. Determine scope

- If a language arg was given: resolve it to one Crowdin target language.
- Otherwise: call `get_project_progress` first and only process languages where
  `translationProgress > approvalProgress` (skip the rest — they have nothing to review).

## 2. Fetch candidates

For each target language, call `list_language_translations` with
`croql: "count of approvals = 0"` — this returns exactly the translated-but-unapproved set
directly from the API (see "Known API details"; do not try to diff a translations list
against an approvals list yourself, see the pitfall noted below). For each result, fetch its
source string **one at a time with `get_string(stringId)`** — do not call `list_strings` in
bulk to "prefetch" sources (see the `list_strings` context-blowout pitfall below). Each
`get_string` call is small and safe. `get_string`'s `context` field frequently contains
translator instructions like "do not translate `:value`" that are directly relevant to the
placeholder check. If a string has plural forms (`hasPlurals: true`), check each plural
form's translation separately against its matching source form.

If the total candidate count across the languages in scope is large (rule of thumb: more
than ~30-40 strings), do the fetch-and-check work for each language in a background fork
(`Agent` with `subagent_type: "fork"`) rather than inline — this keeps the ~139-call, mostly
uninteresting `get_string`/checking traffic out of the main conversation's context, and lets
you report a clean final summary. Give the fork the exact candidate list (stringId,
translationId, translation text, language) already fetched, the source-project ID, and the
4 checks; tell it explicitly not to call any write tools (`add_approval`, `delete_translation`,
`add_string_comment`) — this stage is report-only. **Verify the fork actually did the work**
before trusting its report: a fork that returns almost immediately with 0 tool calls did not
execute anything and just echoed the task back — resume it (`SendMessage` to its agent id)
with an explicit "you didn't do this, actually call the tools now" instruction rather than
accepting that result.

## 3. Verify each candidate

Run all four checks below on every (source, translation) pair. Be conservative — only
flag a check when you're reasonably confident it's actually wrong; translation is a fuzzy
domain and near-miss phrasing is not a defect.

1. **Meaning accuracy** — mentally back-translate the translation into English and compare
   it to the source string's meaning. Flag only a material divergence (wrong meaning,
   missing/added clause, wrong tone for an error vs. success message, etc.), not stylistic
   differences.
2. **Rich-text tag markers** — extract all `<N>`, `</N>`, `<N/>`-style numbered tags (e.g.
   `<0>`, `</0>`, `<1/>`) from source and translation. Flag if the multiset of tags doesn't
   match exactly (missing, extra, or renumbered tags — renumbering breaks the mapping even
   if the count matches).
3. **Laravel placeholders** — extract all `:word` tokens (e.g. `:value`, `:count`,
   `:attribute`) from source and translation. Flag if the set of placeholder names doesn't
   match exactly. (Case sensitivity matters — Laravel's `:Value`/`:VALUE` capitalization
   variants must be preserved as the same casing pattern used in source, if present.)
4. **Empty / gibberish** — flag if the translation is blank/whitespace-only, or is clearly
   not real language content (keyboard mashing, a string of punctuation, obvious copy-paste
   of the untranslated key, etc.). Don't flag short-but-valid translations (e.g. a single
   word correctly translating a single word).

## 4. Report

Present a report grouped by language:

- Total candidates checked, count clean, count flagged.
- For each flagged string: string identifier/key, source text, translation text, which
  check(s) failed, and a one-line explanation.

Do not approve, comment, or otherwise write anything yet.

## 5. Act, only on confirmation

This step performs write actions on the user's Crowdin project — always confirm before
executing, and do it in two independently-confirmable batches:

- **Approve the clean ones** — ask if the user wants the strings that passed all four
  checks approved now. If yes, approve each and report a count.
- **Flag the failing ones** — ask if the user wants a comment added to each flagged
  string explaining the specific issue (for translators to see). If yes, post one comment
  per flagged string with a concise explanation of what's wrong (prefixed with that
  language's Discord role mention per the "Discord role mentions" table above, if it has
  one), and report a count.

Never approve a string that failed any check, even if the user only asked to "approve
what's ready."

## Known API details (learned from testing 2026-09-09, project 750053)

- **CroQL for "translated but not approved"**: `list_language_translations` accepts a
  `croql` param. The working query is:
  ```
  count of approvals = 0
  ```
  (single `=`, not `==`). This returned exactly the string count matching the
  `translationProgress`/`approvalProgress` gap from `get_project_progress` — treat that gap
  as the expected candidate count and sanity-check against it.
  - `not is approved` fails with `croqlInvalidLogic: Identifier 'isApproved' is undefined`
    — there is no bare `is approved` field on the translation object, despite the general
    CroQL docs example. Use the `approvals` array (`count of approvals = 0`) instead.
  - `translation.dateApproved is empty` fails with a syntax error — don't use dotted
    `translation.*` field paths or an `is empty` operator here.
- **Pitfall: don't diff translations vs. approvals lists yourself.** `list_translation_approvals`
  and `list_language_translations` (without croql) both cap at `limit: 500` per call. On a
  project this size, computing "translated minus approved" by fetching both lists and
  diffing `stringId`s undercounts/overcounts because either side can silently truncate at
  500 without you noticing (no error — it just returns 500 rows). The `croql` filter above
  avoids this entirely by having the server do the filtering. If a language ever needs more
  than 500 candidates, paginate with `offset` on the croql-filtered call, not on unfiltered
  lists.
- **Large result payloads**: `list_language_translations`/`list_translation_approvals`
  without a narrow filter can return responses too large for a single tool result (hit a
  146K-character response fetching all `zh-TW` approvals with `limit: 500`). Always filter
  with `croql` and/or a specific `languageId` rather than pulling broad unfiltered lists.
- **`list_strings` blows the context budget on this project even at defaults.** A plain
  `list_strings(projectId, limit: 500)` call — no filter, just the tool's own default
  fields — returned ~113K characters (project has ~313-500 source strings; the `context`
  field on many of them is long) and errored as exceeding the max tool-result size. There is
  no field-removal option (the `fields` param only *adds* to the defaults, it can't trim
  `context` out), and CroQL on `list_strings` has **no `in`/list operator** — `id in
  (2516, 2518)` fails with `croqlInvalidSyntax`, and CroQL's own docs don't document one
  either, so you can't narrow a bulk fetch down to just your candidate stringIds that way.
  **Don't call `list_strings` in bulk at all for this skill.** Fetch each needed source
  string individually with `get_string(stringId)` instead — one small call per candidate.
  If you must page through *all* source strings for some other reason, use a `limit` well
  under 500 (e.g. 50-100) and paginate with `offset`, checking each page doesn't itself blow
  the size limit.
- **Source string text lives outside the translation tool sets.** `get_string` (and
  `list_strings`/`search_strings`) are gated behind the `source_strings` tool set, separate
  from `string_translations` — both are required together for this skill to work at all.
- **`get_string`'s `context` field is meaningful**, not boilerplate — it's often the only
  place a "do not translate `:xxx`" instruction appears, which directly informs the
  placeholder-preservation check (check 3).
