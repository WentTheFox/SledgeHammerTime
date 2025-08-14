<script setup lang="ts">
import TimestampCard from '@/Components/home/TimestampCard.vue';
import UsefulLinks from '@/Components/home/UsefulLinks.vue';
import { dateTimeLibraryInject, timestamp } from '@/injection-keys';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { convertTimeZoneSelectionToString } from '@/utils/time';
import { router, usePage } from '@inertiajs/vue3';
import { computed, inject, onMounted, provide, readonly, Ref, ref } from 'vue';
import { useRoute } from 'ziggy-js';

const page = usePage();
const route = useRoute();
const dtl = inject(dateTimeLibraryInject);

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

const currentTimestamp = computed(() => dtl?.value.getValueForIsoZonedDateTime(dateString.value, timeString.value, currentTimezone.value) ?? null);
const isLocked = computed(() => defaultUnixTimestamp.value !== null);

const changeDateString = (value: string) => {
  dateString.value = value;
};
const changeTimeString = (value: string) => {
  timeString.value = value;
};
const changeDateTimeString = (value: string) => {
  const [newDateString, newTimeString] = value.split(/[ T]/);
  dateString.value = newDateString;
  timeString.value = newTimeString;
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
const locale = computed(() => page.props.app.locale);
const lock = () => {
  const params = new URLSearchParams();
  params.set('t', String(dtl?.value.fromIsoString(dateString.value + 'T' + timeString.value).getUnixSeconds()));
  params.set('tz', convertTimeZoneSelectionToString(currentTimezone.value));
  router.get(`/${locale.value}?${params}`, undefined, { replace: true });
};
const unlock = () => {
  const params = new URLSearchParams();
  params.set('tz', convertTimeZoneSelectionToString(currentTimezone.value));
  backupLastTime([dateString.value, timeString.value]);
  router.get(`/${locale.value}?${params}`, undefined, { replace: true });
};
const backupLastTime = (value: [string, string]) => {
  sessionStorage.setItem('lockedDateTime', value.join('T'));
};
const restoreLastTime = () => {
  const backupValue = sessionStorage.getItem('lockedDateTime');
  if (!backupValue) return null;
  sessionStorage.removeItem('lockedDateTime');
  return backupValue.split('T');
};

provide(timestamp, {
  currentTimestamp,
  isLocked,
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

onMounted(() => {
  [dateString.value, timeString.value] = restoreLastTime() ?? dtl?.value.getDefaultInitialDateTime(currentTimezone.value, defaultUnixTimestamp.value) ?? ['', ''];
});
</script>

<template>
  <TimestampCard />

  <UsefulLinks />
</template>
