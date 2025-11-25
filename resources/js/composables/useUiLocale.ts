import { PageProps } from '@/types';
import { AvailableLanguage } from '@/utils/language-settings';
import { computed, Ref } from 'vue';

export const useUiLocale = (pageProps: Ref<PageProps> | undefined, locale: Ref<string>) =>
  computed<AvailableLanguage>(() => (pageProps!.value.app?.languages[locale.value] ?? locale.value) as AvailableLanguage);
