import { CookieLocalSettingSource } from '@/classes/CookieLocalSettingSource';
import { isValidHourCycle } from '@/classes/DateTimeLibraryLocale';
import { DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { LocalStorageLocalSettingSource } from '@/classes/LocalStorageLocalSettingSource';
import {
  InitialBooleanValueFn,
  useLocalBooleanSetting,
} from '@/composables/useLocalBooleanSetting';
import { useLocalSelectSetting } from '@/composables/useLocalSelectSetting';
import { CurrentLanguageData } from '@/injection-keys';
import { isValidMessageTimestampFormat } from '@/model/message-timestamp-format';
import { PageProps } from '@/types';
import type { Chrono } from 'chrono-node';
import { computed, DeepReadonly, onMounted, Ref, ref, watch } from 'vue';

const hourCyclePrefKey = 'hour-cycle';
const firstDayOfWeekPrefKey = 'first-day-of-week';
const localHiddenFormatsPrefKey = 'local-hidden-formats';
const localFormatOrderPrefKey = 'local-format-order';

const trueByDefault: InitialBooleanValueFn = (storedPref) => ({ result: storedPref !== 'false' });
const falseByDefault: InitialBooleanValueFn = (storedPref) => ({ result: storedPref === 'true' });
const nullByDefault: InitialBooleanValueFn = (storedPref) =>
  ({ result: storedPref === null ? null : storedPref === 'true' });

export const useLocalSettings = (currentLanguage: Ref<CurrentLanguageData> | undefined, chrono: DeepReadonly<Ref<Chrono | null>>, pagePropsRef: Ref<PageProps>) => {
  const localStorageSettingSource = new LocalStorageLocalSettingSource();
  const settingSource = new CookieLocalSettingSource(pagePropsRef, localStorageSettingSource);
  const naturalLanguageInputAvailable = computed(() => Boolean(chrono.value));
  const setInitialCombinedInput: InitialBooleanValueFn = (storedPref: string | null) => {
    const storedLegacyPref = localStorage.getItem('split-input');
    if (storedLegacyPref !== null) {
      return { result: storedLegacyPref !== 'true', save: true };
    }
    if (storedPref !== null) {
      return { result: storedPref === 'true' };
    }

    // Feature detection for datetime-local input
    const testInput = document.createElement('input');
    testInput.setAttribute('type', 'datetime-local');
    const testValue = '1)';
    testInput.value = testValue;
    return { result: testInput.value !== testValue, save: true };
  };

  const {
    value: flatUiEnabled,
    toggleByCheckboxEvent: toggleFlatUi,
  } = useLocalBooleanSetting(settingSource, 'flat-ui', falseByDefault);
  const {
    value: naturalLanguageInputEnabled,
    toggleByCheckboxEvent: toggleNaturalLanguageInput,
  } = useLocalBooleanSetting(
    settingSource,
    'nlp-input',
    falseByDefault,
    v => Boolean(v) && naturalLanguageInputAvailable.value,
  );
  const {
    value: combinedInputsEnabled,
    toggleByCheckboxEventInverted: toggleSeparateInputs,
  } = useLocalBooleanSetting(settingSource, 'combined-inputs', setInitialCombinedInput);
  const {
    value: customDateInputEnabled,
    toggleByCheckboxEvent: toggleCustomDateInput,
  } = useLocalBooleanSetting(settingSource, 'custom-date-input', trueByDefault);
  const {
    value: customTimeInputEnabled,
    toggleByCheckboxEvent: toggleCustomTimeInput,
  } = useLocalBooleanSetting(settingSource, 'custom-time-input', trueByDefault);
  const {
    value: sidebarOnRight,
    rawValue: rawSidebarOnRight,
    toggle: toggleSidebarOnRight,
  } = useLocalBooleanSetting(
    settingSource,
    'sidebar-right',
    falseByDefault,
    v => currentLanguage?.value.languageConfig?.rtl ? !v : v,
  );
  const { value: sidebarOpen, setValue: setSidebarOpen } = useLocalBooleanSetting(
    settingSource,
    'sidebar-open',
    nullByDefault,
  );
  const { value: isLightTheme, setValue: setLightTheme } = useLocalBooleanSetting(
    settingSource,
    'light-theme',
    nullByDefault,
  );
  const {
    value: timezoneStickyHeaders,
    toggleByCheckboxEvent: toggleTimezoneStickyHeaders,
  } = useLocalBooleanSetting(
    settingSource,
    'timezone-sticky-headers',
    trueByDefault,
  );
  const {
    value: hideHowTo,
    setValue: setHideHowTo,
  } = useLocalBooleanSetting(
    settingSource,
    'hide-how-to',
    falseByDefault,
  );
  const {
    value: hourCycle,
    setValueBySelectEvent: setHourCycle,
  } = useLocalSelectSetting(
    settingSource,
    hourCyclePrefKey,
    v => {
      const isValid = isValidHourCycle(v);
      return ({ result: isValid ? v : null, save: !isValid });
    },
    isValidHourCycle,
  );
  const firstDayOfWeek = ref<DateTimeLibraryWeekday | null>(null);
  const localHiddenFormats = ref<string[]>([]);
  const localFormatOrder = ref<string[]>([]);

  watch(firstDayOfWeek, (newValue) => {
    if (newValue === null) {
      localStorage.removeItem(firstDayOfWeekPrefKey);
      return;
    }
    localStorage.setItem(firstDayOfWeekPrefKey, newValue.toString());
  });
  watch(localHiddenFormats, (newValue) => {
    localStorage.setItem(localHiddenFormatsPrefKey, JSON.stringify(newValue));
  }, { deep: true });
  watch(localFormatOrder, (newValue) => {
    localStorage.setItem(localFormatOrderPrefKey, JSON.stringify(newValue));
  }, { deep: true });

  const setInitialFirstDayOfWeek = () => {
    const storedPref = localStorage.getItem(firstDayOfWeekPrefKey);
    if (storedPref !== null) {
      const parsed = parseInt(storedPref, 10);
      if (parsed >= 0 && parsed <= 6) {
        firstDayOfWeek.value = parsed as DateTimeLibraryWeekday;
      }
    }
  };
  const setInitialLocalHiddenFormats = () => {
    const raw = localStorage.getItem(localHiddenFormatsPrefKey);
    if (!raw) return;
    try {
      const parsed = JSON.parse(raw);
      if (Array.isArray(parsed)) {
        localHiddenFormats.value = parsed.filter(
          (v): v is string => isValidMessageTimestampFormat(v) || v === 'unix',
        );
      }
    } catch { /* ignore malformed data */
    }
  };
  const setInitialLocalFormatOrder = () => {
    const raw = localStorage.getItem(localFormatOrderPrefKey);
    if (!raw) return;
    try {
      const parsed = JSON.parse(raw);
      if (Array.isArray(parsed)) {
        localFormatOrder.value = parsed.filter(
          (v): v is string => isValidMessageTimestampFormat(v) || v === 'unix',
        );
      }
    } catch { /* ignore malformed data */
    }
  };

  onMounted(() => {
    setInitialFirstDayOfWeek();
    setInitialLocalHiddenFormats();
    setInitialLocalFormatOrder();
  });

  return {
    naturalLanguageInputEnabled,
    toggleNaturalLanguageInput,
    flatUiEnabled,
    toggleFlatUi,
    combinedInputsEnabled,
    toggleSeparateInputs,
    customDateInputEnabled,
    toggleCustomDateInput,
    customTimeInputEnabled,
    toggleCustomTimeInput,
    sidebarOnRight,
    rawSidebarOnRight,
    toggleSidebarOnRight,
    sidebarOpen,
    setSidebarOpen,
    isLightTheme,
    setLightTheme,
    timezoneStickyHeaders,
    toggleTimezoneStickyHeaders,
    hideHowTo,
    setHideHowTo,
    naturalLanguageInputAvailable,
    hourCycle,
    setHourCycle,
    firstDayOfWeek,
    setFirstDayOfWeek(e: Event) {
      if (!(e.target instanceof HTMLSelectElement)) return;

      const value = e.target.value;
      const parsed = parseInt(value, 10);
      firstDayOfWeek.value = !isNaN(parsed) && parsed >= 0 && parsed <= 6
        ? parsed as DateTimeLibraryWeekday
        : null;
    },
    localHiddenFormats,
    localFormatOrder,
    toggleLocalHiddenFormat(format: string) {
      const idx = localHiddenFormats.value.indexOf(format);
      if (idx >= 0) {
        localHiddenFormats.value.splice(idx, 1);
      } else {
        localHiddenFormats.value.push(format);
      }
    },
    setLocalFormatOrder(order: string[]) {
      localFormatOrder.value = order;
    },
  };
};
