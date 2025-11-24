import { LanguageConfigV2 } from '@/model/language-config';
import localeConfig from '../../../lang/config.json' with { type: 'json' };

export type AvailableLanguage = keyof typeof localeConfig.languages;

export type LatestLanguageConfigType = LanguageConfigV2;
type LanguagesConfig = Record<AvailableLanguage, LatestLanguageConfigType>;

export const LANGUAGES = localeConfig.languages as LanguagesConfig;

export const isAvailableLanguage = (language: string): language is AvailableLanguage => language in LANGUAGES;

export const FALLBACK_LANGUAGE: AvailableLanguage = 'en';


