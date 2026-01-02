import { CurrentLanguageData } from '@/injection-keys';
import { computed, onMounted, Ref, ref, watch } from 'vue';

const splitPrefKey = 'split-input';
const flatUiPrefKey = 'flat-ui';
const customDatePrefKey = 'custom-date-input';
const customTimePrefKey = 'custom-time-input';
const sidebarPrefKey = 'sidebar-right';
const sidebarOffDesktopPrefKey = 'sidebar-off-desktop';
const lightThemePrefKey = 'light-theme';
const autoTimeSyncPrefKey = 'auto-time-sync';

const trueByDefault = (storedPref: string|null):boolean => storedPref !== 'false';
const falseByDefault = (storedPref: string|null):boolean => storedPref === 'true';
const nullByDefault = (storedPref: string|null):boolean|null =>
  storedPref === null ? null : storedPref === 'true';

export const useLocalSettings = (currentLanguage?: Ref<CurrentLanguageData>) => {
  const customDateInputEnabled = ref<boolean | null>(null);
  const customTimeInputEnabled = ref<boolean | null>(null);
  const combinedInputsEnabled = ref<boolean | null>(null);
  const flatUiEnabled = ref<boolean | null>(null);
  const sidebarOnRight = ref<boolean | null>(null);
  const sidebarOffDesktop = ref<boolean | null>(null);
  const isLightTheme = ref<boolean | null>(null);
  const autoTimeSync = ref<boolean | null>(null);

  const effectiveSidebarOnRight = computed(() => (
    currentLanguage?.value.languageConfig?.rtl ? !sidebarOnRight.value : sidebarOnRight.value
  ));

  watch(customDateInputEnabled, (newValue) => {
    localStorage.setItem(customDatePrefKey, newValue ? 'true' : 'false');
  });
  watch(customTimeInputEnabled, (newValue) => {
    localStorage.setItem(customTimePrefKey, newValue ? 'true' : 'false');
  });
  watch(combinedInputsEnabled, (newValue) => {
    localStorage.setItem(splitPrefKey, newValue ? 'false' : 'true');
  });
  watch(flatUiEnabled, (newValue) => {
    localStorage.setItem(flatUiPrefKey, newValue ? 'true' : 'false');
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
  const setInitialFlatUi = () => {
    const storedPref = localStorage.getItem(flatUiPrefKey);
    // Disable flat UI by default
    flatUiEnabled.value = falseByDefault(storedPref);
  };
  const setInitialCustomDateInput = () => {
    const storedPref = localStorage.getItem(customDatePrefKey);
    // Enable custom date input by default
    customDateInputEnabled.value = trueByDefault(storedPref);
  };
  const setInitialCustomTimeInput = () => {
    const storedPref = localStorage.getItem(customTimePrefKey);
    // Enable custom time input by default
    customTimeInputEnabled.value = trueByDefault(storedPref);
  };
  const setInitialSidebarOnRight = () => {
    const storedPref = localStorage.getItem(sidebarPrefKey);
    // The sidebar is on the left by default
    sidebarOnRight.value = falseByDefault(storedPref);
  };
  const setInitialSidebarOffDesktop = () => {
    const storedPref = localStorage.getItem(sidebarOffDesktopPrefKey);
    // The sidebar is shown on desktop by default
    sidebarOffDesktop.value = falseByDefault(storedPref);
  };
  const setInitialLightTheme = () => {
    const storedPref = localStorage.getItem(lightThemePrefKey);
    // The feature is unset by default
    isLightTheme.value = nullByDefault(storedPref);
  };
  const setInitialAutoTimeSync = () => {
    const storedPref = localStorage.getItem(autoTimeSyncPrefKey);
    // The feature is disabled by default
    autoTimeSync.value = falseByDefault(storedPref);
  };

  onMounted(() => {
    setInitialFlatUi();
    setInitialCombinedInput();
    setInitialCustomDateInput();
    setInitialCustomTimeInput();
    setInitialSidebarOnRight();
    setInitialSidebarOffDesktop();
    setInitialLightTheme();
    setInitialAutoTimeSync();
  });

  return {
    customDateInputEnabled,
    customTimeInputEnabled,
    combinedInputsEnabled,
    flatUiEnabled,
    sidebarOnRight: effectiveSidebarOnRight,
    rawSidebarOnRight: sidebarOnRight,
    sidebarOffDesktop,
    isLightTheme,
    autoTimeSync,
    toggleCustomDateInput(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      customDateInputEnabled.value = e.target.checked;
    },
    toggleCustomTimeInput(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      customTimeInputEnabled.value = e.target.checked;
    },
    toggleSeparateInputs(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      combinedInputsEnabled.value = !e.target.checked;
    },
    toggleFlatUi(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      flatUiEnabled.value = e.target.checked;
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
