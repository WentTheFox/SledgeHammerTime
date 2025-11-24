import { PageProps } from '@/types';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { computed, Ref } from 'vue';
import type { route as ziggyRoute } from 'ziggy-js';

export const useRouteParams = (route: typeof ziggyRoute, pageProps: Ref<PageProps> | undefined) =>
  computed(() => ({ locale: pageProps?.value.app?.fallbackLocale || FALLBACK_LANGUAGE, ...route().params }));
