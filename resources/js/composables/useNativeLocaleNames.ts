import { AvailableLanguage } from '@/utils/language-settings';
import nativeLocaleNames from '../../../vendor/laravel-lang/native-locale-names/data/_native.json';

export const useNativeLocaleNames = (): Record<string, string> => {
  const availableNativeLocaleNames: Record<AvailableLanguage, string> = {
    ...nativeLocaleNames,
    'en': 'English, US',
    'en-GB': 'English, UK',
    'zh': nativeLocaleNames['zh_CN'],
    'zh-TW': nativeLocaleNames['zh_TW'],
    'pt-BR': nativeLocaleNames['pt_BR'],
    'sr': nativeLocaleNames['sr_Latn'],
  };

  return {
    ...availableNativeLocaleNames,
    'en_GB': availableNativeLocaleNames['en-GB'],
  };
};
