import { TranslationCreditOverride } from '@/model/translation-credit-override';

export interface ReportUserData {
  username: string;
  fullName?: string;
  avatarUrl: string;
  languages?: string[];
}

export interface NormalizedCredits {
  displayName: string;
  url: string;
  avatarUrl?: string | null;
}

export interface TranslationCompletionData {
  translation: number;
  approval: number;
}

export interface LocaleReportData {
  credits: NormalizedCredits[];
  progress: TranslationCompletionData | null;
}

export interface IndexedReportData {
  users: Partial<Record<string, ReportUserData>>;
  languages: Partial<
    Record<
      string,
      {
        translatorIds: string[];
        progress: TranslationCompletionData;
        overrides: Record<string, TranslationCreditOverride>;
      }
    >
  >;
}

export const fallbackTranslationCompletionData: TranslationCompletionData = { translation: 100, approval: 100 };
