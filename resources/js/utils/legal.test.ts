import { describe, expect, it } from 'vitest';
import { getGdprArticle6Url, shouldShowPrivacyNotice } from './legal';

const updatedAt = '2026-11-12T22:13:02.000Z';

describe('shouldShowPrivacyNotice', () => {
  it('shows when it was never dismissed', () => {
    expect(shouldShowPrivacyNotice(null, updatedAt)).toBe(true);
  });

  it('stays hidden when dismissed after the latest update', () => {
    expect(shouldShowPrivacyNotice('2026-11-13T08:00:00.000Z', updatedAt)).toBe(false);
    expect(shouldShowPrivacyNotice(updatedAt, updatedAt)).toBe(false);
  });

  it('shows again when the policy was updated after the dismissal', () => {
    expect(shouldShowPrivacyNotice('2026-11-12T10:00:00.000Z', updatedAt)).toBe(true);
  });

  it('shows when the stored value is not a date', () => {
    expect(shouldShowPrivacyNotice('garbage', updatedAt)).toBe(true);
  });
});

describe('getGdprArticle6Url', () => {
  const base = 'https://eur-lex.europa.eu/legal-content';
  const tail = '/TXT/HTML/?uri=CELEX:32016R0679#art_6';

  it('uses the language of the UI when the EU publishes the GDPR in it', () => {
    expect(getGdprArticle6Url('de')).toBe(`${base}/DE${tail}`);
    expect(getGdprArticle6Url('fr')).toBe(`${base}/FR${tail}`);
  });

  it('uses the language without the region', () => {
    expect(getGdprArticle6Url('pt-BR')).toBe(`${base}/PT${tail}`);
    expect(getGdprArticle6Url('en_GB')).toBe(`${base}/EN${tail}`);
  });

  it('falls back to English for languages that are not official EU languages', () => {
    expect(getGdprArticle6Url('ja')).toBe(`${base}/EN${tail}`);
    expect(getGdprArticle6Url('zh-CN')).toBe(`${base}/EN${tail}`);
    expect(getGdprArticle6Url('nb')).toBe(`${base}/EN${tail}`);
  });
});
