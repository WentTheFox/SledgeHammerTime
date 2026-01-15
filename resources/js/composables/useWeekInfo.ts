import { DateTimeLibraryLocale, WeekInfo } from '@/classes/DateTimeLibraryLocale';
import { DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { LocalSettingsValue } from '@/injection-keys';
import { computed, ComputedRef, DeepReadonly } from 'vue';

export const useWeekInfo = (settings: LocalSettingsValue | undefined, dateLibLocale: DeepReadonly<ComputedRef<DateTimeLibraryLocale | null>>): ComputedRef<WeekInfo> =>
  computed(() => {
    return {
      firstDay: settings?.firstDayOfWeek ?? dateLibLocale.value?.getWeekInfo()?.firstDay ?? DateTimeLibraryWeekday.Monday,
    };
  });
