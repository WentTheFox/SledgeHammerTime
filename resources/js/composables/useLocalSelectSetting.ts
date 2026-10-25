import { useLocalSetting } from '@/composables/useLocalSetting';
import { LocalSettingSource } from '@/model/local-setting-source';

export type InitialStringValueFn = (storedPref: string | null) => {
  result: string | null,
  save?: boolean
};

export const useLocalSelectSetting = (source: LocalSettingSource, prefKey: string, initialValueFn: InitialStringValueFn, valueValidator: (v: unknown) => v is string | null, calculateEffectiveValue?: ((refValue: string | null) => string | null)) => {
  const { value, rawValue, setValue } = useLocalSetting({
    prefKey,
    initialValueFn,
    calculateEffectiveValue,
    source,
    valueValidator,
  });

  return {
    value,
    rawValue,
    setValue,
    setValueBySelectEvent(e: Event) {
      if (!(e.target instanceof HTMLSelectElement)) return;

      setValue(e.target.value);
    },
  };
};
