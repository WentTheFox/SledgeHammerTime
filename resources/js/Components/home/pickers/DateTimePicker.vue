<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import DatePickerCalendar from '@/Components/home/pickers/controls/DatePickerCalendar.vue';
import PickerFormActions from '@/Components/home/pickers/controls/PickerFormActions.vue';
import TimePickerDial from '@/Components/home/pickers/controls/TimePickerDial.vue';
import DatePickerInputs from '@/Components/home/pickers/DatePickerInputs.vue';
import TimePickerInputs from '@/Components/home/pickers/TimePickerInputs.vue';
import { useDatePicker } from '@/composables/useDatePicker';
import { useTimePicker } from '@/composables/useTimePicker';
import { dateTimeLibraryInject, devModeInject, localSettingsInject } from '@/injection-keys';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import HtPopup, { CustomPopupApi, Focusable } from '@/Reusable/HtPopup.vue';
import { DialMode } from '@/utils/dial';
import {
  limitDate,
  limitHours,
  limitMinutesSeconds,
  limitMonth,
  limitToTwelveHours,
} from '@/utils/time';
import { inject, ref, useTemplateRef, watch } from 'vue';

const dtl = inject(dateTimeLibraryInject);
const devMode = inject(devModeInject);
const settings = inject(localSettingsInject);
const {
  year,
  month,
  date,
  calendar,
  changeDateFocus,
  datePickerOpen,
  setDate,
  getSelectedDate,
  dateInput,
  monthInput,
  yearInput,
} = useDatePicker();
const {
  hours,
  minutes,
  seconds,
  isAm,
  dial,
  renderDial,
  twelveHourMode,
  hoursInput,
  minutesInput,
  secondsInput,
  setHours,
  setMinutes,
  setSeconds,
  changeTimeFocus,
  timePickerOpen,
  getSelectedTime,
  openTimePicker,
  closeTimePicker,
} = useTimePicker(dtl);
const timeInputValue = ref<string>('');

const emit = defineEmits<{
  (e: 'selected', date: string): void;
}>();

const popupRef = useTemplateRef<CustomPopupApi>('popup-el');
const formRef = useTemplateRef<HTMLFormElement>('form-el');
const timeInputRef = useTemplateRef<InputApi>('time-input-el');

const select = () => {
  const selectedTimeValue = devMode?.value ? getSelectedTime() : timeInputValue.value;
  emit('selected', `${getSelectedDate()}T${selectedTimeValue}`);
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
  if (settings?.customTimeInputEnabled) {
    timePickerOpen(initialValue);
  }
  timeInputValue.value = initialValue.toISOTimeString();
  popupRef.value?.open(focusOnClose);
};
const close = () => {
  popupRef.value?.close();
};

const changeFocus = (input: 'year' | 'month' | 'date' | DialMode, setSelection: boolean = false) => {
  switch (input) {
    case 'year':
    case 'month':
    case 'date':
      changeDateFocus(input, setSelection);
      break;
    case DialMode.Hours:
    case DialMode.Minutes:
    case DialMode.Seconds:
      changeTimeFocus(input, setSelection);
      break;
  }
};

const setDateAndUpdateFocus = (newYear: number, newMonth: number, newDate: number) => {
  setDate(newYear, newMonth, newDate);
  if (!settings?.customTimeInputEnabled) {
    timeInputRef.value?.focus();
  }
};

watch([year, month, date], () => {
  calendar.value?.setSelection(year.value, month.value, date.value);
});

export interface DateTimePickerApi {
  open: typeof open;
  changeFocus: typeof changeFocus;
}

defineExpose<DateTimePickerApi>({
  open,
  changeFocus,
});
</script>

<template>
  <HtPopup
    ref="popup-el"
    :wide="Boolean(settings?.customTimeInputEnabled)"
    @close="closeTimePicker"
    @open="openTimePicker"
  >
    <form
      ref="form-el"
      @submit.prevent="selectAndClose"
    >
      <div class="datetime-picker-controls">
        <div class="picker-date-control">
          <HtFormInputGroup
            v-if="devMode"
            dir="ltr"
            class="picker-date-inputs"
          >
            <DatePickerInputs
              v-model:date-input="dateInput"
              v-model:month-input="monthInput"
              v-model:year-input="yearInput"
              v-model:year="year"
              v-model:month="month"
              v-model:date="date"
              :halve-bases="true"
            />
          </HtFormInputGroup>
          <DatePickerCalendar
            ref="calendar"
            :selected-year="year"
            :selected-month="limitMonth(month)"
            :selected-date="limitDate(date)"
            @set-date="setDateAndUpdateFocus"
          />
        </div>
        <div
          v-if="settings?.customTimeInputEnabled"
          class="picker-time-control"
        >
          <HtFormInputGroup
            dir="ltr"
            class="picker-date-inputs"
          >
            <TimePickerInputs
              v-model:hours-input="hoursInput"
              v-model:minutes-input="minutesInput"
              v-model:seconds-input="secondsInput"
              v-model:hours="hours"
              v-model:minutes="minutes"
              v-model:seconds="seconds"
              v-model:is-am="isAm"
              v-model:twelve-hour-mode="twelveHourMode"
              v-model:dial="dial"
            />
          </HtFormInputGroup>
          <TimePickerDial
            v-if="renderDial"
            ref="dial"
            :hours="twelveHourMode ? limitToTwelveHours(hours) : limitHours(hours)"
            :minutes="limitMinutesSeconds(minutes)"
            :seconds="limitMinutesSeconds(seconds)"
            :is-am="isAm"
            :twelve-hour-mode="twelveHourMode"
            @set-hours="setHours"
            @set-minutes="setMinutes"
            @set-seconds="setSeconds"
            @change-focus="changeTimeFocus"
            @select="selectAndClose"
          />
        </div>
      </div>
      <div
        v-if="!settings?.customTimeInputEnabled"
        class="mt-2 mb-2"
      >
        <HtInput
          id="date-time-picker-time-input"
          ref="time-input-el"
          v-model="timeInputValue"
          step="1"
          type="time"
        />
      </div>
      <PickerFormActions @close="close" />
    </form>
  </HtPopup>
</template>

<style lang="scss">
@use "../../../../css/design";

.picker-date-inputs {
  @include design.screen-below('md') {
    input {
      text-align: center;
      @include design.hide-spin-buttons;
    }
  }
}

.datetime-picker-controls {
  display: flex;
  flex-flow: row wrap;
  box-sizing: border-box;
  align-items: center;
  justify-content: center;
  gap: .5em;

  @include design.screen-above('md') {
    flex-wrap: nowrap;
    align-items: flex-start;
    justify-content: flex-start;
  }

  .picker-date-control {
    flex: 1 1 100%;
    max-width: 22em;

    @include design.screen-above('md') {
      flex-basis: auto;
    }
  }

  .picker-time-control {
    flex: 0 1 260px;
    min-width: 0;
  }
}
</style>
