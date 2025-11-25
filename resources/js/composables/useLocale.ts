import { PageProps } from '@/types';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { computed, Ref } from 'vue';

export const useLocale = (pageProps: Ref<PageProps> | undefined) =>
  computed<string>(() => (pageProps!.value.app?.locale ?? FALLBACK_LANGUAGE));
