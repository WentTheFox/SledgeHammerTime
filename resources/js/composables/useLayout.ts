import { DateFnsDTL } from '@/classes/DateFnsDTL';
import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { MomentDTL } from '@/classes/MomentDTL';
import { IDDQD, useCheatCode } from '@/composables/useCheatCode';
import { useLocalSettings } from '@/composables/useLocalSettings';
import { useSidebarState } from '@/composables/useSidebarState';
import { useTheme } from '@/composables/useTheme';
import {
  CurrentLanguageData,
  currentLanguageInject,
  dateTimeLibraryInject,
  devModeInject,
  localSettings,
  pagePropsInject,
  scrollToAnchorInject,
  sidebarState,
  themeInject,
} from '@/injection-keys';
import { PageProps } from '@/types';
import { computeCurrentLanguage } from '@/utils/app';
import { router, usePage } from '@inertiajs/vue3';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { computed, onMounted, onUnmounted, provide, readonly, ref, watch } from 'vue';

export const useLayout = () => {
  const pagePropsRef = ref<PageProps>(usePage().props);
  provide(pagePropsInject, pagePropsRef);
  const devModeRef = useCheatCode(IDDQD);
  provide(devModeInject, devModeRef);
  let routerHandlerCleanup: VoidFunction | undefined;
  onMounted(() => {
    routerHandlerCleanup = router.on('success', (event) => {
      pagePropsRef.value = event.detail.page.props;
    });

    if (document) {
      document.body.classList.remove('no-anim');
    }
  });
  onUnmounted(() => {
    routerHandlerCleanup?.();
  });

  const inertiaPage = usePage();
  watch(() => inertiaPage.props, newProps => {
    pagePropsRef.value = newProps;
  }, { immediate: true });

  const currentLanguage = ref<CurrentLanguageData>(computeCurrentLanguage(pagePropsRef.value));
  provide(currentLanguageInject, currentLanguage);

  const localSettingsValue = readonly(useLocalSettings(currentLanguage));
  provide(sidebarState, readonly(useSidebarState(localSettingsValue)));
  provide(localSettings, localSettingsValue);
  provide(themeInject, readonly(useTheme(localSettingsValue)));

  const dateTimeLibrary = computed((): DateTimeLibrary => localSettingsValue.dateFnsEnabled ? new DateFnsDTL() : new MomentDTL());
  provide(dateTimeLibraryInject, readonly(dateTimeLibrary));

  watch(pagePropsRef, (currentPage) => {
    currentLanguage.value = computeCurrentLanguage(currentPage);
    const { locale, languageConfig } = currentLanguage.value;
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
