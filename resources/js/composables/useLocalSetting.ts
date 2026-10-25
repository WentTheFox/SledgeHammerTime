import { LocalSettingSource } from '@/model/local-setting-source';
import { computed, onMounted, ref, watch } from 'vue';

export type InitialValueFn<T> = (storedPref: string | null) => { result: T | null, save?: boolean };
export type ValueValidatorFn<T> = (value: unknown) => value is T | null;

export interface LocalSettingOptions<T> {
  prefKey: string;
  initialValueFn: InitialValueFn<T>;
  /**
   * Validation function which needs to return true when the value is valid.
   * If false is returned, the value will be set to `null`.
   */
  valueValidator: ValueValidatorFn<T>;
  calculateEffectiveValue?: ((refValue: T | null) => T | null);
  source: LocalSettingSource;
}

export const useLocalSetting = <T>({
  prefKey,
  initialValueFn,
  valueValidator,
  calculateEffectiveValue,
  source,
}: LocalSettingOptions<T>) => {
  const settingRef = ref<T | null>(null);

  const effectiveValue = computed(() => (
    calculateEffectiveValue ? calculateEffectiveValue(settingRef.value) : settingRef.value
  ));

  const setInitialValue = () => {
    const storedPref = source.getItem(prefKey);
    const { result, save } = initialValueFn(storedPref);
    settingRef.value = result;
    if (save) {
      persistValue(result);
    }
  };
  const persistValue = (newValue: T | null) => {
    if (newValue === null) {
      source.removeItem(prefKey);
      return;
    }
    source.setItem(prefKey, String(newValue));
  };
  const setValue = (newValue: T | null) => {
    settingRef.value = newValue;
  };
  const setValueFromInputEvent = (e: Event) => {
    if (!(e.target instanceof HTMLInputElement)) return;

    const targetValue = e.target.value;
    setValue(valueValidator(targetValue) ? targetValue : null);
  };


  // Set initial value on mount to prevent SSR hydration mismatch
  onMounted(() => setInitialValue());

  // Persistence
  watch(settingRef, (newValue) => {
    persistValue(newValue);
  });

  return {
    value: effectiveValue,
    rawValue: settingRef,
    setValue,
    setValueFromInputEvent,
  };
};
