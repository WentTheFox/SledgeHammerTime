import { DateFnsDTL } from '@/classes/DateFnsDTL';
import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { useTimeSync } from '@/composables/useTimeSync';
import { computed } from 'vue';
import type { route as ziggyRoute } from 'ziggy-js';

export const useDateTimeLibrary = (route: typeof ziggyRoute) => {
  const dateTimeLibrary = computed((): DateTimeLibrary => new DateFnsDTL());
  const timeSync = useTimeSync(route('app.ntp'), dateTimeLibrary);

  return { dateTimeLibrary, timeSync };
};
