import reportDataJson from '../../../lang/crowdin.json' with { type: 'json' };

export interface ReportUserData {
  username: string;
  fullName?: string;
  avatarUrl: string;
  languages?: string[];
}

export interface TranslationCompletionData {
  translation: number;
  approval: number;
}

export interface IndexedReportData {
  users: Partial<Record<string, ReportUserData>>;
  languages: Partial<
    Record<
      string,
      {
        translatorIds: string[];
        progress: TranslationCompletionData;
      }
    >
  >;
}

export const reportData = reportDataJson as unknown as IndexedReportData;

export const getTranslationCompletionData = (language: string): TranslationCompletionData | null => reportData.languages[language]?.progress || null;

export const getTranslationCompletePercent = (value: TranslationCompletionData | null | undefined): number =>
  typeof value !== 'undefined' && value !== null ? value.approval : 0;

export const getIsTranslationComplete = (value: TranslationCompletionData | undefined | null | number): boolean =>
  (typeof value === 'number' ? value : getTranslationCompletePercent(value)) === 100;
