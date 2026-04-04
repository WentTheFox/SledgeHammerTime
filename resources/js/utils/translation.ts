import { TranslationCreditOverride } from '@/model/translation-credit-override';
import { IndexedReportData, NormalizedCredits, ReportUserData } from '@/utils/crowdin';

export const getTranslatorIds = (
  currentLocaleReportData?: IndexedReportData['languages'][string],
): string[] =>
  Array.from(
    new Set([
      ...(currentLocaleReportData?.translatorIds ?? []),
    ]),
  );

export const normalizeCredit = (
  crowdinId: string,
  overridesRecord?: Record<string, TranslationCreditOverride | null>,
  reportData?: IndexedReportData,
): NormalizedCredits | null => {
  const overrides = overridesRecord?.[crowdinId];
  if (overrides === null) {
    return null;
  }
  let details: ReportUserData | undefined;
  if (crowdinId) {
    details = reportData?.users?.[crowdinId];
    if (!details) {
      console.warn(`Missing crowdin data for user ID ${crowdinId}`);
    }
  }
  const displayName = overrides?.displayName ?? details?.fullName ?? details?.username;
  if (!displayName) {
    return null;
  }
  let url = overrides?.url;
  if (!url) {
    if (!details) {
      throw new Error(`URL is required for credit:\n${JSON.stringify(overrides)}`);
    }
    url = `https://crowdin.com/profile/${details.username}`;
  }
  return {
    displayName,
    url,
    avatarUrl: overrides?.avatarUrl ?? details?.avatarUrl,
  };
};

export interface BotCommandTranslation {
  id: string;
  commandId: string;
  optionId: string | null;
  locale: string;
  field: string;
  value: string;
}

interface GetBotCommandTranslationKeyOptions {
  commandId: string;
  optionId?: string | null;
  choiceId?: string | null;
  field: string;
}

export const getBotCommandTranslationKey = ({
  commandId,
  optionId = null,
  choiceId = null,
  field,
}: GetBotCommandTranslationKeyOptions) =>
  `${commandId}.${optionId}.${choiceId}.${field}`;
