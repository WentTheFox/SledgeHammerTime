<script setup lang="ts">
import type { InputSelectorImplProps } from '@/Components/home/inputs/InputSelector.vue';
import DatePicker, { DatePickerApi } from '@/Components/home/pickers/DatePicker.vue';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { useFormControlDisabled } from '@/composables/useFormControlDisabled';
import { useFormControlId } from '@/composables/useFormControlId';
import { dateTimeLibraryInject, positionAnchor, timestampInject } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { keyboardOrMouseEventHandlerFactory } from '@/utils/events';
import { computed, inject, provide, useTemplateRef } from 'vue';

const props = defineProps<InputSelectorImplProps>();

const ts = inject(timestampInject);
const id = useFormControlId();
const effectiveDisabled = useFormControlDisabled(props);
const dtl = inject(dateTimeLibraryInject);

const dateLibLocale = useDateLibraryLocale(dtl);
const selectedDate = computed(() => {
  if (dtl?.value && dateLibLocale.value) {
    const currentDateValue = ts?.currentDate.value;
    if (currentDateValue) {
      const currentTimezoneValue = ts?.currentTimezone.value;
      if (currentTimezoneValue) {
        return dtl.value.convertIsoToLocalizedDateInputValue(
          currentDateValue,
          dateLibLocale.value,
        );
      }
    }
  }

  return '';
});
const datepicker = useTemplateRef<DatePickerApi>('date-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

const openPopup = keyboardOrMouseEventHandlerFactory((_: KeyboardEvent | MouseEvent, viaKeyboard: boolean) => {
  if (!ts) return;

  const currentTs = ts.currentTimestamp.value;
  if (!currentTs) {
    console.error('Could not get current timestamp with timezone');
    return;
  }
  datepicker.value?.open(currentTs, viaKeyboard ? inputEl.value?.inputEl : null);
  window.requestAnimationFrame(() => {
    datepicker.value?.changeFocus('year', true);
  });
});

const changeDate = (value: string) => {
  ts?.changeDateString(value);
};

const positionAnchorName = '--date-input';
provide(positionAnchor, positionAnchorName);
</script>

<template>
  <div>
    <HtInput
      :id="id"
      ref="input-el"
      :model-value="selectedDate"
      :readonly="true"
      :disabled="effectiveDisabled"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @keydown="openPopup"
    />
    <DatePicker
      ref="date-picker"
      :select-on-click="true"
      @selected="changeDate"
    />
  </div>
</template>
