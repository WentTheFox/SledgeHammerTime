<script setup lang="ts">
import LocalTimeComboboxAddon from '@/Components/LocalTimeComboboxAddon.vue';
import { currentLanguageInject, dateTimeLibraryInject } from '@/injection-keys';
import HtFormCombobox, { FormComboboxApi } from '@/Reusable/HtFormCombobox.vue';
import { ComboboxOption } from '@/utils/combobox';
import { getTimezoneValue } from '@/utils/time';
import { computed, inject, useTemplateRef } from 'vue';

const props = defineProps<{
  'class'?: string;
  name?: string;
  tabindex?: string | number;
}>();


const dtl = inject(dateTimeLibraryInject);
const currentLanguage = inject(currentLanguageInject);
const timezones = computed(() => {
  const locale = currentLanguage?.value.locale ?? 'en';
  return dtl?.value.timezoneNames.map(tz => getTimezoneValue(tz, locale)) ?? [];
});

const model = defineModel<string>();
const emit = defineEmits<{
  (e: 'change', value: string): void;
  (e: 'focus'): void;
}>();

const formComboboxRef = useTemplateRef<FormComboboxApi>('form-combobox');

const changeTimezone = (option: ComboboxOption) => {
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
    :options="timezones"
    :addon-component="LocalTimeComboboxAddon"
    @change="changeTimezone"
    @focus="emit('focus')"
  />
</template>
