import { useLocalSetting } from '@/composables/useLocalSetting';
import { LocalSettingSource } from '@/model/local-setting-source';

export type InitialBooleanValueFn = (storedPref: string | null) => {
  result: boolean | null,
  save?: boolean
};

export const useLocalBooleanSetting = (source: LocalSettingSource, prefKey: string, initialValueFn: InitialBooleanValueFn, calculateEffectiveValue?: ((refValue: boolean | null) => boolean | null)) => {
  const { value, rawValue, setValue } = useLocalSetting({
    prefKey,
    initialValueFn,
    calculateEffectiveValue,
    valueValidator: v => typeof v === 'boolean',
    source,
  });

  const toggleByCheckboxEvent = ({ e, uncheckedMeansTrue }: {
    e: Event,
    uncheckedMeansTrue: boolean
  }) => {
    if (!(e.target instanceof HTMLInputElement)) return;

    setValue(uncheckedMeansTrue ? !e.target.checked : e.target.checked);
  };

  return {
    value,
    rawValue,
    setValue,
    toggle() {
      setValue(!rawValue.value);
    },
    toggleByCheckboxEvent(e: Event) {
      toggleByCheckboxEvent({ e, uncheckedMeansTrue: false });
    },
    toggleByCheckboxEventInverted(e: Event) {
      toggleByCheckboxEvent({ e, uncheckedMeansTrue: true });
    },
  };
};
