import { clientHydrated } from '@/composables/useClientHydrated';
import { PageProps } from '@/types';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { computed, Ref } from 'vue';
import type { route as ziggyRoute } from 'ziggy-js';

interface UseRouteParamsOptions {
  /**
   * Include the URL's query parameters in the server render too. Only for pages that read their own parameters at setup (the picker's
   * `t` and `tz`) and are never cached when those are present.
   */
  includeQueryOnServer?: boolean;
}

/**
 * The parameters links to other routes are built from: the current route's path parameters, plus the URL's query parameters (so e.g. the
 * picker's `t` and `tz` carry over to other pages). The query parameters are only added once the client has taken over, because the
 * server render is cached and shared between URLs, it must not depend on them.
 */
export const useRouteParams = (route: typeof ziggyRoute, pageProps: Ref<PageProps> | undefined, options: UseRouteParamsOptions = {}) =>
  computed<Record<string, string>>(() => ({
    locale: pageProps?.value.app?.fallbackLocale || FALLBACK_LANGUAGE,
    ...(options.includeQueryOnServer || clientHydrated.value ? route().params : route().routeParams),
  }));
