export enum LegalSectionIds {
  PRIVACY_POLICY = 'privacy-policy',
  INFO_COLLECTION = 'info-collection',
  LOG_DATA = 'log-data',
  PERFORMANCE_MONITORING = 'performance-monitoring',
  PERFORMANCE_MONITORING_OPT_OUT = 'performance-monitoring-opt-out',
  TELEMETRY_STATISTICS = 'telemetry-statistics',
  COOKIES = 'cookies',
  YOUR_RIGHTS = 'your-rights',
  RIGHT_TO_OBJECT = 'right-to-object',
  SECURITY = 'security',
  TERMS_AND_CONDITIONS = 'terms-and-conditions',
  CHANGES = 'changes',
  CONTACT = 'contact',
}

/**
 * The site-wide notice about a policy update is shown until it is dismissed. A later update (a newer `updatedAtIso`)
 * shows it again to everyone, including those who dismissed it before that.
 */
export const shouldShowPrivacyNotice = (dismissedAtIso: string | null, updatedAtIso: string): boolean =>
  dismissedAtIso === null || !(Date.parse(dismissedAtIso) >= Date.parse(updatedAtIso));

/** The languages the GDPR is published in on EUR-Lex (the official languages of the EU), by their two letter code */
const EUR_LEX_LANGUAGES = new Set([
  'bg', 'cs', 'da', 'de', 'el', 'en', 'es', 'et', 'fi', 'fr', 'ga', 'hr', 'hu', 'it', 'lt', 'lv', 'mt', 'nl', 'pl', 'pt',
  'ro', 'sk', 'sl', 'sv',
]);

/**
 * Article 6 (lawfulness of processing) of the GDPR on EUR-Lex, in the language of the UI when the EU publishes it in
 * that language and in English otherwise. `art_6` is the id of the article in the full text.
 */
export const getGdprArticle6Url = (uiLocale: string): string => {
  const primaryLanguage = uiLocale.split(/[-_]/)[0].toLowerCase();
  const eurLexLanguage = EUR_LEX_LANGUAGES.has(primaryLanguage) ? primaryLanguage : 'en';

  return `https://eur-lex.europa.eu/legal-content/${eurLexLanguage.toUpperCase()}/TXT/HTML/?uri=CELEX:32016R0679#art_6`;
};
