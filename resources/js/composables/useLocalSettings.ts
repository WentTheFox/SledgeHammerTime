import { HourCycle, isValidHourCycle } from '@/classes/DateTimeLibraryLocale';
import { DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { CurrentLanguageData } from '@/injection-keys';
import { Chrono } from 'chrono-node';
import { computed, DeepReadonly, onMounted, Ref, ref, watch } from 'vue';

const splitPrefKey = 'split-input';
const flatUiPrefKey = 'flat-ui';
const nlpPrefKey = 'nlp-input';
const customDatePrefKey = 'custom-date-input';
const customTimePrefKey = 'custom-time-input';
const sidebarPrefKey = 'sidebar-right';
const sidebarOpenPrefKey = 'sidebar-open';
const lightThemePrefKey = 'light-theme';
const hourCyclePrefKey = 'hour-cycle';
const firstDayOfWeekPrefKey = 'first-day-of-week';

const trueByDefault = (storedPref: string | null): boolean => storedPref !== 'false';
const falseByDefault = (storedPref: string | null): boolean => storedPref === 'true';
const nullByDefault = (storedPref: string | null): boolean | null =>
  storedPref === null ? null : storedPref === 'true';

export const useLocalSettings = (currentLanguage: Ref<CurrentLanguageData> | undefined, chrono: DeepReadonly<Ref<Chrono | null>>) => {
  const naturalLanguageInputEnabled = ref<boolean | null>(null);
  const customDateInputEnabled = ref<boolean | null>(null);
  const customTimeInputEnabled = ref<boolean | null>(null);
  const combinedInputsEnabled = ref<boolean | null>(null);
  const flatUiEnabled = ref<boolean | null>(null);
  const sidebarOnRight = ref<boolean | null>(null);
  const sidebarOpen = ref<boolean | null>(null);
  const isLightTheme = ref<boolean | null>(null);
  const hourCycle = ref<HourCycle | null>(null);
  const firstDayOfWeek = ref<DateTimeLibraryWeekday | null>(null);

  const effectiveSidebarOnRight = computed(() => (
    currentLanguage?.value.languageConfig?.rtl ? !sidebarOnRight.value : sidebarOnRight.value
  ));
  const naturalLanguageInputAvailable = computed(() => Boolean(chrono.value));
  const effectiveNaturalLanguageInputEnabled = computed(() => (
    Boolean(naturalLanguageInputEnabled.value) && naturalLanguageInputAvailable.value
  ));

  watch(naturalLanguageInputEnabled, (newValue) => {
    localStorage.setItem(nlpPrefKey, newValue ? 'true' : 'false');
  });
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
  watch(sidebarOpen, (newValue) => {
    if (newValue === null) {
      localStorage.removeItem(sidebarOpenPrefKey);
      return;
    }
    localStorage.setItem(sidebarOpenPrefKey, newValue ? 'true' : 'false');
  });
  watch(isLightTheme, (newValue) => {
    if (newValue === null) {
      localStorage.removeItem(lightThemePrefKey);
      return;
    }
    localStorage.setItem(lightThemePrefKey, newValue ? 'true' : 'false');
  });
  watch(hourCycle, (newValue) => {
    if (newValue === null) {
      localStorage.removeItem(hourCyclePrefKey);
      return;
    }
    localStorage.setItem(hourCyclePrefKey, newValue);
  });
  watch(firstDayOfWeek, (newValue) => {
    if (newValue === null) {
      localStorage.removeItem(firstDayOfWeekPrefKey);
      return;
    }
    localStorage.setItem(firstDayOfWeekPrefKey, newValue.toString());
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
  const setInitialNaturalLanguageInput = () => {
    const storedPref = localStorage.getItem(nlpPrefKey);
    // Disable NLP input by default
    naturalLanguageInputEnabled.value = falseByDefault(storedPref);
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
  const setInitialSidebarOpen = () => {
    const storedPref = localStorage.getItem(sidebarOpenPrefKey);
    // The sidebar is shown on desktop by default
    sidebarOpen.value = nullByDefault(storedPref);
  };
  const setInitialLightTheme = () => {
    const storedPref = localStorage.getItem(lightThemePrefKey);
    // The feature is unset by default
    isLightTheme.value = nullByDefault(storedPref);
  };
  const setInitialHourCycle = () => {
    const storedPref = localStorage.getItem(hourCyclePrefKey);
    if (isValidHourCycle(storedPref)) {
      hourCycle.value = storedPref as HourCycle;
    }
  };
  const setInitialFirstDayOfWeek = () => {
    const storedPref = localStorage.getItem(firstDayOfWeekPrefKey);
    if (storedPref !== null) {
      const parsed = parseInt(storedPref, 10);
      if (parsed >= 0 && parsed <= 6) {
        firstDayOfWeek.value = parsed as DateTimeLibraryWeekday;
      }
    }
  };

  onMounted(() => {
    setInitialFlatUi();
    setInitialNaturalLanguageInput();
    setInitialCombinedInput();
    setInitialCustomDateInput();
    setInitialCustomTimeInput();
    setInitialSidebarOnRight();
    setInitialSidebarOpen();
    setInitialLightTheme();
    setInitialHourCycle();
    setInitialFirstDayOfWeek();
  });

  return {
    naturalLanguageInputEnabled: effectiveNaturalLanguageInputEnabled,
    naturalLanguageInputAvailable,
    customDateInputEnabled,
    customTimeInputEnabled,
    combinedInputsEnabled,
    flatUiEnabled,
    sidebarOnRight: effectiveSidebarOnRight,
    rawSidebarOnRight: sidebarOnRight,
    sidebarOpen,
    isLightTheme,
    hourCycle,
    firstDayOfWeek,
    toggleNaturalLanguageInput(e: Event) {
      if (!(e.target instanceof HTMLInputElement)) return;

      naturalLanguageInputEnabled.value = e.target.checked;
    },
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
    setSidebarOpen(value: boolean) {
      sidebarOpen.value = value;
    },
    setLightTheme(isLight: boolean | null) {
      isLightTheme.value = isLight;
    },
    setHourCycle(e: Event) {
      if (!(e.target instanceof HTMLSelectElement)) return;

      hourCycle.value = isValidHourCycle(e.target.value) ? e.target.value : null;
    },
    setFirstDayOfWeek(e: Event) {
      if (!(e.target instanceof HTMLSelectElement)) return;

      const value = e.target.value;
      const parsed = parseInt(value, 10);
      firstDayOfWeek.value = !isNaN(parsed) && parsed >= 0 && parsed <= 6
        ? parsed as DateTimeLibraryWeekday
        : null;
    },
  };
};
