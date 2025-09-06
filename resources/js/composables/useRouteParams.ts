import { PageProps } from '@/types';
import { computed, Ref } from 'vue';
import type { route as ziggyRoute } from 'ziggy-js';

export const useRouteParams = (route: typeof ziggyRoute, pageProps: Ref<PageProps> | undefined) =>
  computed(() => ({ locale: pageProps?.value.app.fallbackLocale || 'en', ...route().params }));
