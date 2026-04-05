import { getDateFnsNormalizedLocaleName, preloadDateFnsLocale } from '@/classes/DateFnsDTL';
import { getAppName } from '@/utils/app';
import { PageProps } from '@/types';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { i18nVue } from 'laravel-vue-i18n';

import { createApp, createSSRApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import '../css/app.scss';
import './bootstrap';

const appName = getAppName();
const langJsonImporters = import.meta.glob('../../lang/php_*.json');
const langJsonPaths = Object.keys(langJsonImporters);
const findLangJsonPath = (lang: string) => langJsonPaths.find(path => path.endsWith(`lang/php_${lang.replace(/^php_/, '')}.json`));

createInertiaApp({
  title: (title) => title ? `${title} - ${appName}` : appName,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    const createAppFn = el.innerHTML.length > 0 ? createSSRApp : createApp;

    const mountAC = new AbortController();
    // Eagerly preload the actual page locale so it's ready when components mount.
    // i18nVue calls resolve() for the fallback lang first, which would mount the app
    // before the real locale (e.g. en-GB) is preloaded, causing a cache miss warning.
    const pageAppProps = (props.initialPage.props as PageProps).app;
    const pageBcp47Locale = pageAppProps?.languages?.[pageAppProps?.locale ?? ''];
    let dateFnsLocalePreload: Promise<void> = preloadDateFnsLocale(
      getDateFnsNormalizedLocaleName(pageBcp47Locale ?? 'en'),
    );
    const app = createAppFn({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(i18nVue, {
        fallbackLang: 'en',
        fallbackMissingTranslations: true,
        resolve: async (lang: string) => {
          const jsonPathForLocale = findLangJsonPath(lang);
          if (!jsonPathForLocale) {
            throw new Error(`Could not find lang json path for lang ${lang}`);
          }
          dateFnsLocalePreload = Promise.all([
            dateFnsLocalePreload,
            preloadDateFnsLocale(getDateFnsNormalizedLocaleName(lang)),
          ]).then(() => undefined);
          const result = await langJsonImporters[jsonPathForLocale]();
          if (typeof result !== 'object' || result === null || !('default' in result)) {
            throw new Error(`Missing default export in json for lang ${lang}`);
          }
          return result;
        },
        onLoad: () => {
          if (mountAC.signal.aborted)
            return;
          mountAC.abort();
          dateFnsLocalePreload.then(() => app.mount(el));
        },
      });
  },
  progress: {
    color: '#5865F2',
  },
});
