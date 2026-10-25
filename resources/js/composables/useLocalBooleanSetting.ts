import { computed, onMounted, ref, watch } from 'vue';

export type InitialValueFn = (storedPref: string | null) => { result: boolean | null, save?: boolean };

export const useLocalBooleanSetting = (prefKey: string, initialValueFn: InitialValueFn, calculateEffectiveValue?: ((refValue: boolean | null) => boolean | null)) => {
  const settingRef = ref<boolean | null>(null);

  const effectiveValue = computed(() => (
    calculateEffectiveValue ? calculateEffectiveValue(settingRef.value) : settingRef.value
  ));

  const setInitialValue = () => {
    const storedPref = localStorage.getItem(prefKey);
    const { result, save } = initialValueFn(storedPref);
    settingRef.value = result;
    if (save) {
      persistValue(result);
    }
  };
  const persistValue = (newValue: boolean|null) => {
    if (newValue === null) {
      localStorage.removeItem(prefKey);
      return;
    }
    localStorage.setItem(prefKey, newValue ? 'true' : 'false');
  };

  const toggleByCheckboxEvent = ({ e, uncheckedMeansTrue }: {
    e: Event,
    uncheckedMeansTrue: boolean
  }) => {
    if (!(e.target instanceof HTMLInputElement)) return;

    settingRef.value = uncheckedMeansTrue ? !e.target.checked : e.target.checked;
  };

  // Set initial value on mount to prevent SSR hydration mismatch
  onMounted(setInitialValue);

  // Persistence
  watch(settingRef, (newValue) => {
    persistValue(newValue);
  });

  return {
    value: effectiveValue,
    rawValue: settingRef,
    toggle() {
      settingRef.value = !settingRef.value;
    },
    setValue(newValue: boolean | null) {
      settingRef.value = newValue;
    },
    toggleByCheckboxEvent(e: Event) {
      toggleByCheckboxEvent({ e, uncheckedMeansTrue: false });
    },
    toggleByCheckboxEventInverted(e: Event) {
      toggleByCheckboxEvent({ e, uncheckedMeansTrue: true });
    },
  };
};
