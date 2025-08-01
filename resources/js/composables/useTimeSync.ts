import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { calculateNtpOffset } from '@/utils/time';
import axios from 'axios';
import { ComputedRef, DeepReadonly, ref } from 'vue';

export const useTimeSync = (dtl: DeepReadonly<ComputedRef<DateTimeLibrary>>) => {
  const t0 = ref<DateTimeLibraryValue | null>(null);
  const t1 = ref<DateTimeLibraryValue | null>(null);
  const t2 = ref<DateTimeLibraryValue | null>(null);
  const t3 = ref<DateTimeLibraryValue | null>(null);

  const ntpOffsetMs = ref(() => 0);

  const syncing = ref(false);

  const syncTime = async (apply: boolean = true) => {
    if (!dtl) return;

    syncing.value = true;
    let newT1: DateTimeLibraryValue | undefined, newT2: DateTimeLibraryValue | undefined;
    const newT0 = dtl.value.now();
    const result = await axios.get(route('app.ntp'));
    const newT3 = dtl.value.now();
    if (result.status !== 200) {
      console.error(`Sync failed (HTTP ${result.status})`);
    } else {
      const { data } = result;
      if ('requestTs' in data && typeof data.requestTs === 'number') {
        newT1 = dtl.value.fromTimestampMsUtc(data.requestTs);
      }
      if ('responseTs' in data && typeof data.requestTs === 'number') {
        newT2 = dtl.value.fromTimestampMsUtc(data.responseTs);
      }
    }
    const newNtpOffsetMs = calculateNtpOffset(
      newT0?.getUnixMilliseconds(),
      newT1?.getUnixMilliseconds(),
      newT2?.getUnixMilliseconds(),
      newT3?.getUnixMilliseconds(),
    );

    ntpOffsetMs.value = newNtpOffsetMs;
    t0.value = newT0;
    t1.value = newT1;
    t2.value = newT2;
    t3.value = newT3;
    syncing.value = false;

    if (apply) {
      dtl.value.updateOffset(Math.round(newNtpOffsetMs));
    }
  };

  return { syncTime, syncing, t0, t1, t2, t3, ntpOffsetMs };
};
