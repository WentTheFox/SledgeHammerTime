<script setup lang="ts">
import TimestampCard from '@/Components/home/TimestampCard.vue';
import UsefulLinks from '@/Components/home/UsefulLinks.vue';
import { useRoute } from '@/composables/useRoute';
import {
  dateTimeLibraryInject,
  localSettingsInject,
  timestampInject,
  timeSyncInject,
} from '@/injection-keys';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { convertTimeZoneSelectionToString } from '@/utils/time';
import { router, usePage } from '@inertiajs/vue3';
import { computed, inject, nextTick, onMounted, provide, readonly, Ref, ref, watch } from 'vue';

const page = usePage();
const route = useRoute();
const dtl = inject(dateTimeLibraryInject);
const settings = inject(localSettingsInject);
const timeSync = inject(timeSyncInject);

const routeParams = computed(() => route().params);

const defaultUnixTimestamp = computed(() => {
  const tParam = routeParams.value.t;
  const locked = typeof tParam !== 'undefined' && !isNaN(Number(tParam));
  return locked ? tParam : null;
});
const defaultTimezone = computed(() => {
  const tzParam = routeParams.value.tz;
  return typeof tzParam !== 'undefined' ? tzParam : (defaultUnixTimestamp.value !== null ? 'Etc/UTC' : undefined);
});

const currentTimezone: Ref<TimezoneSelection> = ref(dtl?.value.getDefaultInitialTimezoneSelection(defaultTimezone.value) ?? {
  type: TimeZoneSelectionType.ZONE_NAME,
  name: 'Etc/UTC',
});
const dateString = ref('');
const timeString = ref('');
const dateTimeSelectionChanged = ref(false);

const currentTimestamp = computed(() => dtl?.value.getValueForIsoZonedDateTime(dateString.value, timeString.value, currentTimezone.value) ?? null);
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
  const normalizedValue = value.length === 5 ? `${value}:00` : value;
  timeString.value = normalizedValue;
};
const changeDateTimeString = (value: string) => {
  if (!dateTimeSelectionChanged.value) {
    dateTimeSelectionChanged.value = true;
  }
  const [newDateString, newTimeString] = value.split(/[ T]/);
  dateString.value = newDateString;
  timeString.value = newTimeString.length === 5 ? `${newTimeString}:00` : newTimeString;
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
const locale = computed(() => page.props.app?.locale ?? 'en');
const uiLocale = computed(() => page.props.app?.languages[locale.value] ?? locale.value);
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

provide(timestampInject, {
  currentTimestamp,
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
