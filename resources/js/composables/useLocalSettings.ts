import { CurrentLanguageData } from '@/injection-keys';
import { computed, onMounted, Ref, ref, watch } from 'vue';

const splitPrefKey = 'split-input';
const customPrefKey = 'custom-input';
const sidebarPrefKey = 'sidebar-right';
const sidebarOffDesktopPrefKey = 'sidebar-off-desktop';
const lightThemePrefKey = 'light-theme';
const autoTimeSyncPrefKey = 'auto-time-sync';

export const useLocalSettings = (currentLanguage?: Ref<CurrentLanguageData>) => {
  const customInputEnabled = ref<boolean | null>(null);
  const combinedInputsEnabled = ref<boolean | null>(null);
  const sidebarOnRight = ref<boolean | null>(null);
  const sidebarOffDesktop = ref<boolean | null>(null);
  const isLightTheme = ref<boolean | null>(null);
  const autoTimeSync = ref<boolean | null>(null);

  const effectiveSidebarOnRight = computed(() => (
    currentLanguage?.value.languageConfig?.rtl ? !sidebarOnRight.value : sidebarOnRight.value
  ));

  watch(customInputEnabled, (newValue) => {
    localStorage.setItem(customPrefKey, newValue ? 'true' : 'false');
  });
  watch(combinedInputsEnabled, (newValue) => {
    localStorage.setItem(splitPrefKey, newValue ? 'false' : 'true');
  });
  watch(sidebarOnRight, (newValue) => {
    localStorage.setItem(sidebarPrefKey, newValue ? 'true' : 'false');
  });
  watch(sidebarOffDesktop, (newValue) => {
    localStorage.setItem(sidebarOffDesktopPrefKey, newValue ? 'true' : 'false');
  });
  watch(isLightTheme, (newValue) => {
    if (newValue === null) {
      localStorage.removeItem(lightThemePrefKey);
      return;
    }
    localStorage.setItem(lightThemePrefKey, newValue ? 'true' : 'false');
  });
  watch(autoTimeSync, (newValue) => {
    localStorage.setItem(autoTimeSyncPrefKey, newValue ? 'true' : 'false');
  });

  const setInitialCombinedInput = () => {
    const storedPref = localStorage.getItem(splitPrefKey);
    if (storedPref !== null) {
      combinedInputsEnabled.value = storedPref !== 'true';
      return;
    }

    // Feature detection for datetime-local input
    const testInput = document.createElement('input');
    testInput.setAttribute('type', 'datetime-local');
    const testValue = '1)';
    testInput.value = testValue;
    combinedInputsEnabled.value = testInput.value !== testValue;
  };
  const setInitialCustomInput = () => {
    const storedPref = localStorage.getItem(customPrefKey);
    // Enable custom input by default
    customInputEnabled.value = storedPref !== 'false';
  };
  const setInitialSidebarOnRight = () => {
    const storedPref = localStorage.getItem(sidebarPrefKey);
    // The sidebar is on the left by default
    sidebarOnRight.value = storedPref === 'true';
  };
  const setInitialSidebarOffDesktop = () => {
    const storedPref = localStorage.getItem(sidebarOffDesktopPrefKey);
    // The sidebar is shown on desktop by default
    sidebarOffDesktop.value = storedPref === 'true';
  };
  const setInitialLightTheme = () => {
    const storedPref = localStorage.getItem(lightThemePrefKey);
    // The feature is enabled by default
    isLightTheme.value = storedPref !== null ? storedPref === 'true' : null;
  };
  const setInitialAutoTimeSync = () => {
    const storedPref = localStorage.getItem(autoTimeSyncPrefKey);
    // The feature is disabled by default
    autoTimeSync.value = storedPref === 'true';
  };

  onMounted(() => {
    setInitialCombinedInput();
    setInitialCustomInput();
    setInitialSidebarOnRight();
    setInitialSidebarOffDesktop();
    setInitialLightTheme();
    setInitialAutoTimeSync();
  });

  return {
    customInputEnabled,
    combinedInputsEnabled,
    sidebarOnRight: effectiveSidebarOnRight,
    rawSidebarOnRight: sidebarOnRight,
    sidebarOffDesktop,
    isLightTheme,
    autoTimeSync,
    toggleCustomInput(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      customInputEnabled.value = e.target.checked;
    },
    toggleSeparateInputs(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      combinedInputsEnabled.value = !e.target.checked;
    },
    toggleSidebarOnRight() {
      sidebarOnRight.value = !sidebarOnRight.value;
    },
    setSidebarOffDesktop(value: boolean) {
      sidebarOffDesktop.value = value;
    },
    setLightTheme(isLight: boolean | null) {
      isLightTheme.value = isLight;
    },
    toggleAutoTimeSync(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      autoTimeSync.value = e.target.checked;
    },
  };
};

export type LocalSettingsValue = ReturnType<typeof useLocalSettings>;
