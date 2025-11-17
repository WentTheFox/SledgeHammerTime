<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import Popup, { CustomPopupApi, Focusable } from '@/Components/CustomPopup.vue';
import DatePickerCalendar from '@/Components/home/pickers/controls/DatePickerCalendar.vue';
import PickerFormActions from '@/Components/home/pickers/controls/PickerFormActions.vue';
import DatePickerInputs from '@/Components/home/pickers/DatePickerInputs.vue';
import { useDatePicker } from '@/composables/useDatePicker';
import { devModeInject } from '@/injection-keys';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import { limitDate, limitMonth } from '@/utils/time';
import { inject, useTemplateRef, watch } from 'vue';

const {
  year,
  month,
  date,
  calendar,
  dateInput, monthInput, yearInput,
  changeDateFocus,
  datePickerOpen,
  setDate,
  getSelectedDate,
} = useDatePicker();

const props = defineProps<{ selectOnClick?: boolean }>();

const emit = defineEmits<{
  (e: 'selected', date: string): void;
}>();

const devMode = inject(devModeInject);

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const formRef = useTemplateRef<HTMLFormElement>('form-el');

const select = () => {
  emit('selected', getSelectedDate());
};
const selectAndClose = () => {
  const focusedEl = formRef.value?.querySelector<HTMLElement>(':focus');
  if (focusedEl) {
    focusedEl.blur();
  }
  select();
  close();
};
const open = (initialValue: DateTimeLibraryValue, focusOnClose?: Focusable | null) => {
  datePickerOpen(initialValue);
  popupRef.value?.open(focusOnClose);
};
const setDateAndSelect = (newYear: number, newMonth: number, newDate: number) => {
  setDate(newYear, newMonth, newDate);

  if (props.selectOnClick) {
    selectAndClose();
    return;
  }
  select();
};
const close = () => {
  popupRef.value?.close();
};

watch([year, month, date], () => {
  calendar.value?.setSelection(year.value, month.value, date.value);
});

export interface DatePickerApi {
  open: typeof open;
  changeFocus: typeof changeDateFocus;
}

defineExpose<DatePickerApi>({
  open,
  changeFocus: changeDateFocus,
});
</script>

<template>
  <Popup ref="popup-el">
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <HtFormInputGroup
        v-if="devMode"
        dir="ltr"
      >
        <DatePickerInputs
          v-model:date-input="dateInput"
          v-model:month-input="monthInput"
          v-model:year-input="yearInput"
          v-model:year="year"
          v-model:month="month"
          v-model:date="date"
        />
      </HtFormInputGroup>
      <DatePickerCalendar
        ref="calendar"
        :selected-year="year"
        :selected-month="limitMonth(month)"
        :selected-date="limitDate(date)"
        @set-date="setDateAndSelect"
      />
      <PickerFormActions
        v-if="!selectOnClick"
        @close="close"
      />
    </form>
  </Popup>
</template>
