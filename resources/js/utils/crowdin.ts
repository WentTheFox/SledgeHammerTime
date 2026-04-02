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

export const getTranslationProgress = (value: TranslationCompletionData | null | undefined): TranslationCompletionData =>
  typeof value !== 'undefined' && value !== null ? value : { translation: 0, approval: 0 };
