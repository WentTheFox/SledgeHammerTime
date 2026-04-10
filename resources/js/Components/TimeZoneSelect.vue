<script setup lang="ts">
import LocalTimeComboboxAddon from '@/Components/LocalTimeComboboxAddon.vue';
import { useTimezoneIndex } from '@/composables/useTimezoneIndex';
import {
  currentLanguageInject,
  dateTimeLibraryInject,
  localSettingsInject,
  timestampInject,
} from '@/injection-keys';
import HtFormCombobox, { FormComboboxApi } from '@/Reusable/HtFormCombobox.vue';
import { getTimezoneAbbreviationAtDate, getTimezoneValue } from '@/utils/time';
import { computed, inject, toRef, useTemplateRef } from 'vue';

const props = defineProps<{
  'class'?: string;
  name?: string;
  tabindex?: string | number;
}>();


const dtl = inject(dateTimeLibraryInject);
const currentLanguage = inject(currentLanguageInject);
const settings = inject(localSettingsInject);
const timestampState = inject(timestampInject);

// Static timezone options - only recomputes when locale or timezone list changes.
const timezones = computed(() => {
  const locale = currentLanguage?.value.locale ?? 'en';
  return dtl?.value.timezoneNames.map(tz => getTimezoneValue(tz, locale)) ?? [];
});

// The selected timestamp as a plain Date for alias lookups.
const selectedDate = computed(() => {
  const ts = timestampState?.currentTimestamp.value;
  return ts ? new Date(ts.toDate().getTime()) : null;
});

// Merges the static options with a secondaryAlias computed from the selected timestamp.
// Kept as a separate computed so static data and time-dependent data invalidate independently.
const timezonesWithSecondaryAlias = computed(() => {
  const date = selectedDate.value;
  if (!date) return timezones.value;
  return timezones.value.map(tz => ({
    ...tz,
    secondaryAlias: getTimezoneAbbreviationAtDate(tz.value, tz.aliases ?? [], date),
  }));
});

const timezoneIndex = useTimezoneIndex(toRef(timezones));

const model = defineModel<string>();
const emit = defineEmits<{
  (e: 'change', value: string): void;
  (e: 'focus'): void;
}>();

const formComboboxRef = useTemplateRef<FormComboboxApi>('form-combobox');

const changeTimezone = (option: { value: string }) => {
  model.value = option.value;
  emit('change', option.value);
};

const focus = () => {
  formComboboxRef.value?.focus();
};

export interface TimeZoneSelectApi {
  focus: typeof focus;
}

defineExpose<TimeZoneSelectApi>({
  focus,
});
</script>

<template>
  <HtFormCombobox
    ref="form-combobox"
    v-model="model"
    :name="name"
    :class="props.class ?? 'mb-0'"
    :tabindex="tabindex"
    :options="timezonesWithSecondaryAlias"
    :addon-component="LocalTimeComboboxAddon"
    :sticky-headers="settings?.timezoneStickyHeaders !== false"
    :search-index="timezoneIndex"
    @change="changeTimezone"
    @focus="emit('focus')"
  />
</template>
