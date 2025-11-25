import { IDDQD, useCheatCode } from '@/composables/useCheatCode';
import { useDateTimeLibrary } from '@/composables/useDateTimeLibrary';
import { useLocalSettings } from '@/composables/useLocalSettings';
import { useRoute } from '@/composables/useRoute';
import { useSidebarState } from '@/composables/useSidebarState';
import { useTheme } from '@/composables/useTheme';
import {
  CurrentLanguageData,
  currentLanguageInject,
  dateTimeLibraryInject,
  devModeInject,
  localSettingsInject,
  pagePropsInject,
  scrollToAnchorInject,
  sidebarState,
  themeInject,
  timeSyncInject,
  userInfoInject,
} from '@/injection-keys';
import { PageProps } from '@/types';
import { computeCurrentLanguage } from '@/utils/app';
import { router, usePage } from '@inertiajs/vue3';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { computed, onMounted, onUnmounted, provide, readonly, ref, watch } from 'vue';

const noAnimClass = 'no-anim';
const flatUiClass = 'flat-ui';
export const useLayout = () => {
  const inertiaPage = usePage();
  const pagePropsRef = ref<PageProps>(inertiaPage.props);
  provide(pagePropsInject, pagePropsRef);
  const userInfo = computed(() => pagePropsRef.value?.auth?.user);
  provide(userInfoInject, userInfo);
  const devModeRef = useCheatCode(IDDQD);
  provide(devModeInject, devModeRef);
  let routerHandlerCleanup: VoidFunction | undefined;
  onMounted(() => {
    routerHandlerCleanup = router.on('success', (event) => {
      pagePropsRef.value = event.detail.page.props;
    });

    if (typeof document !== 'undefined') {
      document.body.classList.remove(noAnimClass);
    }
  });
  onUnmounted(() => {
    routerHandlerCleanup?.();
  });

  watch(() => inertiaPage.props, newProps => {
    pagePropsRef.value = newProps;
  }, { immediate: true });

  const currentLanguage = computed<CurrentLanguageData>(() => computeCurrentLanguage(pagePropsRef.value));
  provide(currentLanguageInject, currentLanguage);

  const localSettings = useLocalSettings(currentLanguage);
  const localSettingsValue = readonly(localSettings);
  provide(sidebarState, readonly(useSidebarState(localSettingsValue)));
  provide(localSettingsInject, localSettingsValue);
  provide(themeInject, readonly(useTheme(localSettingsValue)));

  const route = useRoute();
  const { dateTimeLibrary, timeSync } = useDateTimeLibrary(route, localSettingsValue);
  provide(dateTimeLibraryInject, dateTimeLibrary);
  provide(timeSyncInject, readonly(timeSync));

  watch(localSettings.flatUiEnabled, (isFlatUiEnabled) => {
    if (typeof document === 'undefined') return;

    if (isFlatUiEnabled) {
      document.body.classList.add(flatUiClass);
    } else {
      document.body.classList.remove(flatUiClass);
    }
  });

  watch(currentLanguage, (currentLanguage) => {
    const { locale, languageConfig } = currentLanguage;
    if (typeof document !== 'undefined' && document.documentElement) {
      document.documentElement.dir = languageConfig?.rtl ? 'rtl' : 'ltr';
    }

    const localeName = dateTimeLibrary.value.getLocaleNameFromLanguageConfig(locale, languageConfig);
    if (localeName) {
      dateTimeLibrary.value.loadLocaleLowLevel(localeName);
    }

    const laravelLocale = languageConfig?.laravelLocale ?? locale;
    if (laravelLocale) {
      loadLanguageAsync(laravelLocale);
    }
  }, {
    immediate: true,
  });

  let scrollFunction: ((progress?: number) => void) | null = null;
  const scrollMaxFrames = 2;
  const scrollToAnchor = (id: string | undefined) => {
    if (!id) return;

    const scrollTargetEl = document.getElementById(id);
    if (!scrollTargetEl) {
      console.warn(`No scroll target found with ID ${id}`);
      return;
    }

    const headerEl = document.querySelector('header.header');
    if (!headerEl) {
      console.warn(`Could not find app header`);
      return;
    }

    const headerHeight = headerEl.getBoundingClientRect().height;

    const containerEl = document.documentElement;
    const getTargetScrollTop = () => {
      const containerScrollTop = Math.max(0, containerEl.scrollTop - headerHeight);
      return containerScrollTop + scrollTargetEl.getBoundingClientRect().top;
    };
    scrollFunction = (scrollFrame = 0) => {
      const targetScrollTop = getTargetScrollTop();
      requestAnimationFrame(() => {
        containerEl.scrollTo(0, targetScrollTop);
        if (scrollFrame < scrollMaxFrames) {
          scrollFunction?.(scrollFrame + 1);
        } else {
          scrollFunction = null;
        }
      });
    };
    scrollFunction();
  };
  provide(scrollToAnchorInject, scrollToAnchor);
};
