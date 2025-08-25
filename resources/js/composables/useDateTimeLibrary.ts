import { DateFnsDTL } from '@/classes/DateFnsDTL';
import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { MomentDTL } from '@/classes/MomentDTL';
import { LocalSettingsValue } from '@/composables/useLocalSettings';
import { useTimeSync } from '@/composables/useTimeSync';
import { computed, DeepReadonly, UnwrapNestedRefs, watch } from 'vue';

export const useDateTimeLibrary = (localSettingsValue: DeepReadonly<UnwrapNestedRefs<LocalSettingsValue>>) => {
  const dateTimeLibrary = computed((): DateTimeLibrary => localSettingsValue.dateFnsEnabled ? new DateFnsDTL() : new MomentDTL());
  const timeSync = useTimeSync(dateTimeLibrary);

  watch(dateTimeLibrary, () => {
    if (!localSettingsValue.autoTimeSync) {
      if (dateTimeLibrary.value.offset !== 0) {
        dateTimeLibrary.value.updateOffset(0);
      }
      return;
    }

    void timeSync.syncTime();
  }, { immediate: true });

  return { dateTimeLibrary, timeSync };
};
