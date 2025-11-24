import { BotInfoUsageData, BotInfoUsageFetchOptions, CurrentLanguageData } from '@/injection-keys';
import { PageProps } from '@/types';
import {
  AvailableLanguage,
  FALLBACK_LANGUAGE,
  LANGUAGES,
  LatestLanguageConfigType,
} from '@/utils/language-settings';
import { rangeLimitInput } from '@/utils/time';
import axios from 'axios';
import { format, subDays } from 'date-fns';
import { ModelRef, Ref } from 'vue';

export const getAppName = () => import.meta.env.VITE_APP_NAME || 'Laravel';
export const DEVELOPER_NAME = 'WentTheFox';
export const DEVELOPER_URL = 'https://went.tf';
export const DEVELOPER_CONTACT_URL = `${DEVELOPER_URL}/#contact`;
export const DEVELOPER_AVATAR_URL = 'https://gravatar.com/avatar/f341ebe7cfc73b35ff4ec66897b5c30d?size=64';

export const TERMS_UPDATE_DATE_ISO = "2025-05-11T04:15:14.251Z";
export const PRIVACY_UPDATE_DATE_ISO = "2025-05-11T04:15:14.251Z";

export const inputRangeLimitBlurHandlerFactory = (numberRef: Ref<number> | ModelRef<number>) => (e: FocusEvent): void => {
  const limitedValue = rangeLimitInput(e.target);
  if (limitedValue === numberRef.value)
    return;

  numberRef.value = limitedValue;
};

export const computeCurrentLanguage = (page: PageProps): CurrentLanguageData => {
  const languages = (page.app?.languages ?? { [FALLBACK_LANGUAGE]: FALLBACK_LANGUAGE }) as Record<string, AvailableLanguage>;
  const locale = languages[page.app?.locale ?? FALLBACK_LANGUAGE];
  const languageConfig: LatestLanguageConfigType | undefined = LANGUAGES[locale];
  const supportedLanguages = new Set(page.app?.supportedLanguages ?? [FALLBACK_LANGUAGE]);
  const crowdinProjectId = page.app?.crowdinProjectId;

  return {
    locale,
    languages,
    languageConfig,
    supportedLanguages,
    crowdinProjectId,
  };
};

export const usageDataFetcherFactory = (apiEndpoint: string) => async (options: BotInfoUsageFetchOptions): Promise<BotInfoUsageData[]> => {
  const params = new URLSearchParams();
  params.set('id', options.id);
  params.set('type', options.type);
  const result = await axios.get(apiEndpoint + '?' + params);
  return result.data as BotInfoUsageData[];
};

export const randomlyGenerateCommandUsageData = (totalCount: number): BotInfoUsageData[] => {
  const results: BotInfoUsageData[] = [];
  let remainingCount = totalCount;
  const distributeDays = 90;
  const amplifyFactor = totalCount / 500;
  const averageDailyUse = totalCount / distributeDays;
  const now = new Date();
  for (let i = distributeDays; i >= 0; i--) {
    const dailyCount = i === 0 || remainingCount < averageDailyUse
      ? remainingCount
      : Math.round(averageDailyUse + (Math.sin(remainingCount / distributeDays) * amplifyFactor));
    remainingCount -= dailyCount;
    results.push({
      date: format(subDays(now, i), 'yyyy-MM-dd'),
      value: dailyCount,
    });
  }
  return results;
};
