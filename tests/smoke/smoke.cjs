#!/usr/bin/env node
/**
 * Post-deploy smoke test for a LIVE SledgeHammerTime site. Read-only: no login, no writes.
 * Plain Node + Playwright, no PHP, database or app checkout needed (run by .github/workflows/smoke.yml).
 *
 * Env:
 *   BASE_URL       site to test (default https://hammertime.cyou)
 *   ARTIFACTS_DIR  where failure screenshots/traces go (default ./smoke-artifacts)
 *   CONCURRENCY    parallel browser pages (default 4)
 *
 * Every page of every public type is loaded twice (the second hit comes from the page cache), and must answer 200 without
 * console errors, page errors, failed requests or 4xx/5xx responses (this catches /build/assets/* and /storage/fonts/* 404s).
 * That includes Vue's 'Hydration completed but contains mismatches': the server render and the client's first render must be identical.
 */
const fs = require('node:fs');
const path = require('node:path');
const {chromium} = require('playwright');

const BASE_URL = (process.env.BASE_URL || 'https://hammertime.cyou').replace(/\/+$/, '');
const ARTIFACTS_DIR = path.resolve(process.env.ARTIFACTS_DIR || 'smoke-artifacts');
const CONCURRENCY = Number(process.env.CONCURRENCY || 4);
const USER_AGENT = 'Mozilla/5.0 (compatible; SledgeHammerTime-Smoke; +https://github.com/WentTheFox/SledgeHammerTime)';
// English, Hungarian, an RTL language and a CJK language
const LOCALES = ['en', 'hu', 'ar', 'ja'];
const PAGES = ['', '/design', '/legal', '/app', '/add-bot', '/analytics'];
const NAV_TIMEOUT = 30_000;

const failures = [];
const fail = (where, message) => {
  failures.push(`${where}: ${message}`);
  console.error(`FAIL ${where}: ${message}`);
};

async function withRetry(where, fn) {
  try {
    await fn(false);
  } catch (firstError) {
    console.warn(`retry ${where} after: ${firstError.message.split('\n')[0]}`);
    try {
      await fn(true);
    } catch (error) {
      fail(where, error.message.split('\n').slice(0, 6).join(' | '));
    }
  }
}

/** A fresh context + page that records everything that should never happen on a healthy site */
async function openPage(browser, name) {
  const context = await browser.newContext({
    userAgent: USER_AGENT,
    timezoneId: 'UTC',
    locale: 'en-US',
    viewport: {width: 1280, height: 900},
  });
  await context.tracing.start({screenshots: true, snapshots: true});
  const page = await context.newPage();
  const problems = [];
  page.on('console', (msg) => {
    if (msg.type() !== 'error') return;
    const text = msg.text();
    // The browser logs a generic line for every failed request, the response/requestfailed listeners report those with the URL
    if (text.startsWith('Failed to load resource')) return;
    problems.push(`console error: ${text} (${msg.location().url})`);
  });
  page.on('pageerror', (error) => problems.push(`page error: ${error.message}`));
  page.on('requestfailed', (request) => {
    const reason = request.failure()?.errorText ?? 'failed';
    if (!/ERR_ABORTED/.test(reason)) problems.push(`request failed: ${request.url()} (${reason})`);
  });
  page.on('response', (response) => {
    // Logged out visitors get a 401 from the user info endpoint by design
    if (response.status() >= 400 && !(response.status() === 401 && response.url().endsWith('/frontend/user-info'))) problems.push(`HTTP ${response.status()}: ${response.url()}`);
  });
  const done = async (ok) => {
    if (!ok) {
      fs.mkdirSync(ARTIFACTS_DIR, {recursive: true});
      const safe = name.replace(/[^a-z0-9]+/gi, '_');
      await page.screenshot({path: path.join(ARTIFACTS_DIR, `${safe}.png`), fullPage: true}).catch(() => {});
      await context.tracing.stop({path: path.join(ARTIFACTS_DIR, `${safe}.zip`)}).catch(() => {});
    } else {
      await context.tracing.stop().catch(() => {});
    }
    await context.close();
  };
  return {page, problems, done};
}

// The server renders the page, so the HTML is there before the client app is; app.ts marks #app once it has mounted (hydrated).
// (Vue sets data-v-app only for client-only mounts, not when hydrating)
const waitForApp = (page) => page.waitForSelector('#app[data-mounted="true"], [data-v-app]', {state: 'attached', timeout: NAV_TIMEOUT});

async function assertHealthy(page, problems, response, url) {
  if (!response) throw new Error(`no response for ${url}`);
  if (response.status() !== 200) throw new Error(`HTTP ${response.status()} for ${url}`);
  await waitForApp(page);
  // Fonts are lazy: wait for them, then require the Montserrat face from the Google Fonts cache to really be loaded
  await page.evaluate(() => document.fonts.ready);
  const fonts = await page.evaluate(() => [...document.fonts].filter((f) => /Montserrat/i.test(f.family)).map((f) => f.status));
  if (!fonts.includes('loaded')) problems.push(`Montserrat font not loaded (faces: ${JSON.stringify(fonts)})`);
  const styled = await page.evaluate(() => document.styleSheets.length > 0 && getComputedStyle(document.body).display !== 'inline');
  if (!styled) problems.push('stylesheet not applied');
  if (problems.length) throw new Error(problems.join(' ; '));
}

async function checkPage(browser, url, pass) {
  const where = `${url} (load ${pass})`;
  await withRetry(where, async () => {
    const {page, problems, done} = await openPage(browser, `${url}-${pass}`);
    let ok = false;
    try {
      const response = await page.goto(BASE_URL + url, {waitUntil: 'load', timeout: NAV_TIMEOUT});
      await assertHealthy(page, problems, response, url);
      ok = true;
    } finally {
      await done(ok);
    }
  });
}

/** Real interactions on the English home page, like tests/Browser does */
async function checkInteractions(browser) {
  const where = '/en interactions';
  await withRetry(where, async () => {
    const {page, problems, done} = await openPage(browser, 'interactions');
    let ok = false;
    try {
      const response = await page.goto(`${BASE_URL}/en`, {waitUntil: 'load', timeout: NAV_TIMEOUT});
      await assertHealthy(page, problems, response, '/en');
      const unix = () => page.locator('[data-testid=timestamp-row-unix] .copyable-text-data').textContent().then((t) => t.trim());

      // Date/time picker opens and changes the output
      const before = await unix();
      await page.getByTestId('datetimepicker-input').click();
      const popup = page.getByTestId('datetime-picker-popup');
      await popup.waitFor({state: 'visible', timeout: 10_000});
      const now = new Date();
      const day = now.getUTCDate() === 15 ? 14 : 15;
      await popup.locator(`label:has(#calendar-button-date-${now.getUTCFullYear()}-${now.getUTCMonth() + 1}-${day})`).click();
      await popup.getByTestId('picker-form-submit-button').click();
      await popup.waitFor({state: 'hidden', timeout: 10_000});
      await page.waitForFunction((old) => document.querySelector('[data-testid=timestamp-row-unix] .copyable-text-data')?.textContent.trim() !== old, before, {timeout: 10_000});

      // Time zone popup applies an offset
      await page.getByTestId('timezonepicker-input').click();
      const tzPopup = page.getByTestId('timezone-picker-popup');
      await tzPopup.waitFor({state: 'visible', timeout: 10_000});
      await tzPopup.locator('input[type=number]').nth(0).fill('2');
      await tzPopup.locator('button[type=submit]').click();
      await page.waitForFunction(() => document.querySelector('[data-testid=timezonepicker-input]')?.value === 'GMT+02:00', null, {timeout: 10_000});

      // Copy button writes the syntax and shows success
      await page.evaluate(() => {
        window.__copied = [];
        navigator.clipboard.writeText = (text) => (window.__copied.push(text), Promise.resolve());
      });
      const syntax = (await page.locator('[data-testid=timestamp-row-unix] .copyable-text-data').textContent()).trim();
      const button = page.locator('[data-testid=timestamp-row-unix] .copyable-text-button');
      await button.click();
      await page.waitForFunction(() => window.__copied.length === 1, null, {timeout: 5_000});
      const copied = await page.evaluate(() => window.__copied[0]);
      if (copied !== syntax) throw new Error(`copied "${copied}" instead of "${syntax}"`);
      if (!(await button.getAttribute('class')).includes('button-success')) throw new Error('copy button did not show success');

      // Language switch goes to the same page in the other language
      await page.locator('.change-language-button').click();
      await page.locator('.language-list').waitFor({state: 'visible', timeout: 10_000});
      await page.locator('a.language-link', {hasText: 'Magyar'}).click();
      await page.waitForURL('**/hu', {timeout: NAV_TIMEOUT});
      await waitForApp(page);

      if (problems.length) throw new Error(problems.join(' ; '));
      ok = true;
    } finally {
      await done(ok);
    }
  });
}

async function checkStatus() {
  const res = await fetch(`${BASE_URL}/status`, {headers: {Accept: 'application/json', 'User-Agent': USER_AGENT}});
  const body = await res.json().catch(() => null);
  if (res.status !== 200 || body?.status !== 'ok') fail('/status', `HTTP ${res.status} ${JSON.stringify(body)}`);
  else console.log(`status ok, build ${body.build ?? '(not reported)'}`);
}

async function checkSitemap() {
  const res = await fetch(`${BASE_URL}/sitemap.xml`, {headers: {'User-Agent': USER_AGENT}});
  const xml = await res.text();
  const urls = [...xml.matchAll(/<loc>\s*([^<\s]+)\s*<\/loc>/g)].map((m) => m[1].replace(/&amp;/g, '&'));
  if (res.status !== 200 || !xml.includes('<urlset') || urls.length < 10) return fail('/sitemap.xml', `HTTP ${res.status}, ${urls.length} URLs`);
  const step = Math.max(1, Math.floor(urls.length / 10));
  for (const url of urls.filter((_, i) => i % step === 0).slice(0, 10)) {
    // The sitemap names the canonical origin; test the same path on the site under test
    const target = BASE_URL + new URL(url).pathname;
    const r = await fetch(target, {headers: {'User-Agent': USER_AGENT}});
    if (r.status !== 200) fail(`sitemap ${target}`, `HTTP ${r.status}`);
  }
}

async function main() {
  console.log(`Smoke testing ${BASE_URL}`);
  const started = Date.now();
  await checkStatus();
  await checkSitemap();

  const browser = await chromium.launch();
  try {
    // Two passes: the first may fill the page cache, the second is served from it
    const queue = [];
    for (const pass of [1, 2]) for (const locale of LOCALES) for (const p of PAGES) queue.push([`/${locale}${p}`, pass]);
    queue.push(['/status', 1], ['/status', 2]);
    const workers = Array.from({length: CONCURRENCY}, async () => {
      for (let job = queue.shift(); job; job = queue.shift()) await checkPage(browser, ...job);
    });
    await Promise.all(workers);
    await checkInteractions(browser);
  } finally {
    await browser.close();
  }

  console.log(`Done in ${Math.round((Date.now() - started) / 1000)}s`);
  if (failures.length) {
    console.error(`\n${failures.length} smoke check(s) failed:\n- ${failures.join('\n- ')}`);
    process.exit(1);
  }
  console.log('All smoke checks passed');
}

main().catch((error) => {
  console.error(error);
  process.exit(1);
});
