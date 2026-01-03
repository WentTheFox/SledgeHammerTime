<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampCard from '@/Components/home/TimestampCard.vue';
import UsefulLinks from '@/Components/home/UsefulLinks.vue';
import { useLocale } from '@/composables/useLocale';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { useUiLocale } from '@/composables/useUiLocale';
import {
  dateTimeLibraryInject,
  localSettingsInject,
  pagePropsInject,
  timestampInject,
  timeSyncInject,
} from '@/injection-keys';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { convertTimeZoneSelectionToString, normalizeTimeString } from '@/utils/time';
import { router } from '@inertiajs/vue3';
import { computed, inject, nextTick, onMounted, provide, readonly, Ref, ref, watch } from 'vue';

const props = defineProps<{
  initialDate?: string;
  initialTime?: string;
  initialTimestamp?: number;
}>();

const dtl = inject(dateTimeLibraryInject);
const settings = inject(localSettingsInject);
const timeSync = inject(timeSyncInject);
const pageProps = inject(pagePropsInject);

const route = useRoute();
const locale = useLocale(pageProps);
const uiLocale = useUiLocale(pageProps, locale);
// const routeParams = useRouteParams(route, pageProps);
const routeParams = useRouteParams(route, pageProps);

const defaultUnixTimestamp = computed(() => {
  const tParam = routeParams.value.t;
  const locked = typeof tParam !== 'undefined' && !isNaN(Number(tParam));
  return locked ? tParam : null;
});
const defaultTimezone = computed(() => {
  const tzParam = routeParams.value.tz;
  return typeof tzParam !== 'undefined' ? tzParam : (defaultUnixTimestamp.value !== null ? 'Etc/UTC' : undefined);
});

const currentTimezone: Ref<TimezoneSelection> = ref((typeof window === 'undefined' ? null : dtl?.value.getDefaultInitialTimezoneSelection(defaultTimezone.value)) ?? {
  type: TimeZoneSelectionType.OFFSET,
  hours: 0,
  minutes: 0,
});
const dateString = ref(props.initialDate ?? '');
const timeString = ref(props.initialTime ?? '');
const nlpDate = ref<DateTimeLibraryValue | null>(null);
const dateTimeSelectionChanged = ref(false);

const currentTimestamp = computed((): DateTimeLibraryValue | null => (nlpDate.value as DateTimeLibraryValue | null) ?? dtl?.value.getValueForIsoZonedDateTime(dateString.value, timeString.value, currentTimezone.value) ?? null);
const isLocked = computed(() => defaultUnixTimestamp.value !== null);
const lockedTimestampUrl = computed(() => {
  const params = new URLSearchParams();
  params.set('t', String(currentTimestamp.value?.getUnixSeconds()));
  params.set('tz', convertTimeZoneSelectionToString(currentTimezone.value));
  return `/${uiLocale.value}?${params}`;
});
const unlockedTimestampUrl = computed(() => {
  const params = new URLSearchParams();
  params.set('tz', convertTimeZoneSelectionToString(currentTimezone.value));
  return `/${uiLocale.value}?${params}`;
});

const changeDateString = (value: string) => {
  if (!dateTimeSelectionChanged.value) {
    dateTimeSelectionChanged.value = true;
  }
  dateString.value = value;
};
const changeTimeString = (value: string) => {
  if (!dateTimeSelectionChanged.value) {
    dateTimeSelectionChanged.value = true;
  }
  timeString.value = normalizeTimeString(value);
};
const changeDateTimeString = (value: string) => {
  if (!dateTimeSelectionChanged.value) {
    dateTimeSelectionChanged.value = true;
  }
  const [newDateString, newTimeString] = value.split(/[ T]/);
  dateString.value = newDateString;
  timeString.value = normalizeTimeString(newTimeString);
};
const changeTimezone = (value: TimezoneSelection) => {
  currentTimezone.value = value;
};
const setCurrentTime = () => {
  if (!dtl?.value) {
    console.error('setCurrentTime: dtl missing');
    return;
  }
  const [newDateString, newTimeString] = dtl.value.getInitialDateTime(currentTimezone.value);
  changeDateString(newDateString);
  changeTimeString(newTimeString);
};
const lock = () => {
  router.get(lockedTimestampUrl.value, undefined, { replace: true });
};
const unlock = () => {
  backupLastTime([dateString.value, timeString.value]);
  router.get(unlockedTimestampUrl.value, undefined, { replace: true });
};
const backupSessionStorageKey = 'lockedDateTime';
const backupLastTime = (value: [string, string]) => {
  sessionStorage.setItem(backupSessionStorageKey, value.join('T'));
};
const restoreLastTime = () => {
  const backupValue = sessionStorage.getItem(backupSessionStorageKey);
  if (!backupValue) return null;
  sessionStorage.removeItem(backupSessionStorageKey);
  return backupValue.split('T');
};
const refresh = () => {
  if (dateTimeSelectionChanged.value) return;
  [dateString.value, timeString.value] = restoreLastTime() ?? dtl?.value.getDefaultInitialDateTime(currentTimezone.value, defaultUnixTimestamp.value) ?? ['', ''];
};
const setNlpDate = (date: Date|null) => {
  nlpDate.value = (date && dtl?.value.fromIsoString(date.toISOString())) || null;
}

provide(timestampInject, {
  currentTimestamp,
  setNlpDate,
  isLocked,
  lockedTimestampUrl,
  unlockedTimestampUrl,
  currentDate: readonly(dateString),
  currentTime: readonly(timeString),
  currentTimezone,
  changeDateString,
  changeTimeString,
  changeDateTimeString,
  changeTimezone,
  setCurrentTime,
  unlock,
  lock,
});

const handleTimeSync = async (newAutoTimeSync: boolean | null | undefined) => {
  if (typeof window === 'undefined') return;
  await nextTick();
  await timeSync?.syncTime(newAutoTimeSync === true);
  await nextTick();
  refresh();
};
onMounted(() => {
  handleTimeSync(settings?.autoTimeSync);
});
watch(() => settings?.autoTimeSync, handleTimeSync);
</script>

<template>
  <TimestampCard />

  <UsefulLinks />
</template>
