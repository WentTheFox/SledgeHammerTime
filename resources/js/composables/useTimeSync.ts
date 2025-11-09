import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { calculateNtpOffset } from '@/utils/time';
import axios from 'axios';
import { ComputedRef, DeepReadonly, ref } from 'vue';

export const useTimeSync = (apiEndpoint: string, dtl: DeepReadonly<ComputedRef<DateTimeLibrary>>) => {
  const t0 = ref<DateTimeLibraryValue | null>(null);
  const t1 = ref<DateTimeLibraryValue | null>(null);
  const t2 = ref<DateTimeLibraryValue | null>(null);
  const t3 = ref<DateTimeLibraryValue | null>(null);

  const ntpOffsetMs = ref(0);

  const syncing = ref(false);

  const syncTime = async (apply: boolean = true) => {
    syncing.value = true;
    let newT1: number, newT2: number;
    const newT0 = Date.now();
    const result = await axios.get(apiEndpoint);
    const newT3 = Date.now();
    if (result.status !== 200) {
      console.error(`Sync failed (HTTP ${result.status})`);
      return;
    }

    const { data } = result;
    if ('requestTs' in data && typeof data.requestTs === 'number') {
      newT1 = data.requestTs;
    } else {
      console.error(`requestTs missing from response data`, data);
      return;
    }
    if ('responseTs' in data && typeof data.requestTs === 'number') {
      newT2 = data.responseTs;
    } else {
      console.error(`responseTs missing from response data`, data);
      return;
    }

    const newNtpOffsetMs = calculateNtpOffset(newT0, newT1, newT2, newT3);
    if (typeof newNtpOffsetMs === 'number') {
      ntpOffsetMs.value = newNtpOffsetMs;
    }
    t0.value = dtl.value.fromTimestampMsUtc(newT0);
    t1.value = dtl.value.fromTimestampMsUtc(newT1);
    t2.value = dtl.value.fromTimestampMsUtc(newT2);
    t3.value = dtl.value.fromTimestampMsUtc(newT3);
    syncing.value = false;

    if (apply) {
      dtl.value.updateOffset(Math.round(ntpOffsetMs.value));
    }
  };

  return { syncTime, syncing, t0, t1, t2, t3, ntpOffsetMs };
};
