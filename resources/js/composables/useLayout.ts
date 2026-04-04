import { IDDQD, useCheatCode } from '@/composables/useCheatCode';
import { useChrono } from '@/composables/useChrono';
import { useDateTimeLibrary } from '@/composables/useDateTimeLibrary';
import { useInputMethod } from '@/composables/useInputMethod';
import { useLocalSettings } from '@/composables/useLocalSettings';
import { useRoute } from '@/composables/useRoute';
import { useTheme } from '@/composables/useTheme';
import {
  chronoInject,
  CurrentLanguageData,
  currentLanguageInject,
  dateTimeLibraryInject,
  devModeInject,
  inputMethodInject,
  isJsUnavailableInject,
  layoutOptionsInject,
  LayoutProps,
  localSettingsInject,
  pagePropsInject,
  scrollToAnchorInject,
  themeInject,
  timeSyncInject,
  userInfoInject,
  userInfoLoadingInject,
} from '@/injection-keys';
import { PageProps, User } from '@/types';
import { computeCurrentLanguage } from '@/utils/app';
import { router, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { computed, onMounted, onUnmounted, provide, readonly, ref, watch } from 'vue';

const noAnimClass = 'no-anim';
const flatUiClass = 'flat-ui';
export const useLayout = (layoutProps: LayoutProps) => {
  provide(layoutOptionsInject, layoutProps);
  const inertiaPage = usePage();
  const pagePropsRef = ref<PageProps>(inertiaPage.props);
  provide(pagePropsInject, pagePropsRef);
  // Home/root routes omit auth.user from page props (for HTML caching).
  // When props carry null, fetch it asynchronously; on other pages use props directly.
  const userInfoFromProps = computed(() => pagePropsRef.value?.auth?.user ?? null);
  const asyncUserInfo = ref<User | null>(null);
  const userInfoLoading = ref(true);
  watch(userInfoFromProps, async (propsUser) => {
    if (propsUser !== null) {
      asyncUserInfo.value = null;
      return;
    }
    if (!import.meta.env.SSR) {
      userInfoLoading.value = true;
      try {
        const { data } = await axios.get<User | null>('/frontend/user-info');
        asyncUserInfo.value = data;
      } catch {
        asyncUserInfo.value = null;
      } finally {
        userInfoLoading.value = false;
      }
    }
  }, { immediate: true });
  const userInfo = computed(() => userInfoFromProps.value ?? asyncUserInfo.value);
  provide(userInfoInject, userInfo);
  provide(userInfoLoadingInject, userInfoLoading);
  const devModeRef = useCheatCode(IDDQD);
  provide(devModeInject, devModeRef);
  let routerHandlerCleanup: VoidFunction | undefined;
  onMounted(() => {
    routerHandlerCleanup = router.on('success', (event) => {
      pagePropsRef.value = event.detail.page.props;
    });

    if (!import.meta.env.SSR) {
      setTimeout(() => {
        document.body.classList.remove(noAnimClass);
      }, 1e3);
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

  const chrono = useChrono(currentLanguage);
  const localSettings = useLocalSettings(currentLanguage, chrono);
  const localSettingsValue = readonly(localSettings);
  provide(localSettingsInject, localSettingsValue);
  provide(themeInject, readonly(useTheme(localSettingsValue)));
  provide(inputMethodInject, readonly(useInputMethod()));
  provide(chronoInject, chrono);

  const isJsUnavailable = ref(true);
  provide(isJsUnavailableInject, readonly(isJsUnavailable));

  const route = useRoute();
  const { dateTimeLibrary, timeSync } = useDateTimeLibrary(route);
  provide(dateTimeLibraryInject, dateTimeLibrary);
  provide(timeSyncInject, readonly(timeSync));

  watch(localSettings.flatUiEnabled, (isFlatUiEnabled) => {
    if (import.meta.env.SSR) return;

    if (isFlatUiEnabled) {
      document.body.classList.add(flatUiClass);
    } else {
      document.body.classList.remove(flatUiClass);
    }
  });

  watch(currentLanguage, (currentLanguage) => {
    const { locale, languageConfig } = currentLanguage;
    if (!import.meta.env.SSR && document.documentElement) {
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

  onMounted(() => {
    isJsUnavailable.value = import.meta.env.SSR;
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
