import { AvailableLanguage } from '@/utils/language-settings';
import { Config } from 'ziggy-js';

export interface User {
  id: number;
  name: string;
  hiddenFormats: string[];
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  app?: {
    name: string;
    locale: string;
    fallbackLocale: string;
    /** Mapping Laravel app locales to UI locales **/
    languages: Record<string, AvailableLanguage>;
    /** List of all supported Laravel app locales **/
    supportedLanguages: AvailableLanguage[];
    crowdinProjectId: string;
  }
  auth: {
    user: User;
  };
  ziggy?: Config;
};
