<script setup lang="ts">
import { TimePickerDialAPI } from '@/Components/home/pickers/controls/TimePickerDial.vue';
import { dateTimeLibraryInject } from '@/injection-keys';
import HtFormInputGroupSymbol from '@/Reusable/HtFormInputGroupSymbol.vue';
import HtFormSelect, { FormSelectApi } from '@/Reusable/HtFormSelect.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { DialMode } from '@/utils/dial';
import { coerceToTwelveHours } from '@/utils/time';
import { computed, inject, nextTick, ref, watch } from 'vue';

const hours = defineModel<number>('hours', { required: true });
const minutes = defineModel<number>('minutes', { required: true });
const seconds = defineModel<number>('seconds', { required: true });
const hoursInputValue = ref<string>('');
const minutesInputValue = ref<string>('');
const secondsInputValue = ref<string>('');
const hoursInputValuePadded = computed(() => hoursInputValue.value.padStart(2, '0'));
const minutesInputValuePadded = computed(() => minutesInputValue.value.padStart(2, '0'));
const secondsInputValuePadded = computed(() => secondsInputValue.value.padStart(2, '0'));
const isAm = defineModel<boolean>('isAm', { required: true });
const twelveHourMode = defineModel<boolean>('twelveHourMode', { required: true });
const dial = defineModel<TimePickerDialAPI | undefined>('dial', { required: true });
const hoursInput = defineModel<HTMLInputElement | null>('hoursInput');
const minutesInput = defineModel<HTMLInputElement | null>('minutesInput');
const secondsInput = defineModel<HTMLInputElement | null>('secondsInput');
const amPmInput = defineModel<FormSelectApi | null>('amPmInput');

const dtl = inject(dateTimeLibraryInject);

const handleHoursFocused = () => dial.value?.setMode(DialMode.Hours);
const handleMinutesFocused = () => dial.value?.setMode(DialMode.Minutes);
const handleSecondsFocused = () => dial.value?.setMode(DialMode.Seconds);

/** Not for use in the template */
const _handleTwentyFourHoursBlur = inputRangeLimitBlurHandlerFactory(hours);
const handleHoursBlur = (e: FocusEvent) => {
  if (!(e.target instanceof  HTMLInputElement)) return;
  if (!twelveHourMode.value) {
    _handleTwentyFourHoursBlur(e);
    return;
  }

  const newHoursValue = parseInt(e.target.value, 10);
  const result = coerceToTwelveHours(newHoursValue);
  if (!result) {
    hours.value = newHoursValue;
    return;
  }

  hours.value = result.hours;
  isAm.value = result.isAm;
};
const handleMinutesBlur = inputRangeLimitBlurHandlerFactory(minutes);
const handleSecondsBlur = inputRangeLimitBlurHandlerFactory(seconds);

const handleAmPmSelectKeydown = (e: KeyboardEvent) => {
  switch (e.key.toLowerCase()) {
    case 'a':
      isAm.value = true;
      break;
    case 'p':
      isAm.value = false;
      break;
    case 'arrowup':
    case 'arrowdown':
      isAm.value = !isAm.value;
      break;
  }
};

const maxHoursValue = computed(() => twelveHourMode.value ? 12 : 23);
const minHoursValue = computed(() => twelveHourMode.value ? 1 : 0);

const adjustHours = (delta: number) => {
  const currentValue = parseInt(hoursInputValuePadded.value, 10);
  let newValue = currentValue + delta;
  if (newValue > maxHoursValue.value) {
    newValue = minHoursValue.value;
  }
  else if (newValue < minHoursValue.value) {
    newValue = maxHoursValue.value;
  }
  hoursInputValue.value = String(newValue);
};

const handleHoursKeydown = (e: Event) => {
  if (!(e instanceof KeyboardEvent) || e.key === 'Tab') return;
  e.preventDefault();
  if (!/^\d$/.test(e.key)) {
    switch (e.key) {
      case 'ArrowUp':
        adjustHours(1);
        break;
      case 'ArrowDown':
        adjustHours(-1);
        break;
    }
    return;
  }

  switch (hoursInputValue.value.length) {
    case 0:
    case 2:
      hoursInputValue.value = e.key;
      break;
    case 1: {
      const nextValue = hoursInputValue.value + e.key;
      let nextValueNumber = parseInt(nextValue, 10);
      const result = twelveHourMode.value ? coerceToTwelveHours(nextValueNumber) : null;
      if (result) {
        nextValueNumber = result.hours;
        isAm.value = result.isAm;
      }
      hoursInputValue.value = String(nextValueNumber);
      nextTick(() => {
        minutesInput.value?.focus();
      });
    }
      break;
  }
};
const handleHoursWheel = (e: WheelEvent) => {
  e.preventDefault();
  adjustHours(e.deltaY < 0 ? 1 : -1);
};

const maxMinutesValue = 59;
const minMinutesValue = 0;

const adjustMinutes = (delta: number) => {
  const currentValue = parseInt(minutesInputValuePadded.value, 10);
  let newValue = currentValue + delta;
  if (newValue > maxMinutesValue) {
    newValue = minMinutesValue;
  }
  else if (newValue < minMinutesValue) {
    newValue = maxMinutesValue;
  }
  minutesInputValue.value = String(newValue);
};

const handleMinutesKeydown = (e: Event) => {
  if (!(e instanceof KeyboardEvent) || e.key === 'Tab') return;
  e.preventDefault();
  if (!/^\d$/.test(e.key)) {
    switch (e.key) {
      case 'ArrowUp':
        adjustMinutes(1);
        break;
      case 'ArrowDown':
        adjustMinutes(-1);
        break;
    }
    return;
  }

  switch (minutesInputValue.value.length) {
    case 0:
    case 2:
      minutesInputValue.value = e.key;
      break;
    case 1: {
      const nextValue = minutesInputValue.value + e.key;
      let nextValueNumber = Math.max(0, Math.min(59, parseInt(nextValue, 10)));
      minutesInputValue.value = String(nextValueNumber);
      nextTick(() => {
        secondsInput.value?.focus();
      });
    }
      break;
  }
};
const handleMinutesWheel = (e: WheelEvent) => {
  e.preventDefault();
  adjustMinutes(e.deltaY < 0 ? 1 : -1);
};

const maxSecondsValue = 59;
const minSecondsValue = 0;

const adjustSeconds = (delta: number) => {
  const currentValue = parseInt(secondsInputValuePadded.value, 10);
  let newValue = currentValue + delta;
  if (newValue > maxSecondsValue) {
    newValue = minSecondsValue;
  }
  else if (newValue < minSecondsValue) {
    newValue = maxSecondsValue;
  }
  secondsInputValue.value = String(newValue);
};

const handleSecondsKeydown = (e: Event) => {
  if (!(e instanceof KeyboardEvent) || e.key === 'Tab') return;
  e.preventDefault();
  if (!/^\d$/.test(e.key)) {
    switch (e.key) {
      case 'ArrowUp':
        adjustSeconds(1);
        break;
      case 'ArrowDown':
        adjustSeconds(-1);
        break;
    }
    return;
  }

  switch (secondsInputValue.value.length) {
    case 0:
    case 2:
      secondsInputValue.value = e.key;
      break;
    case 1: {
      const nextValue = secondsInputValue.value + e.key;
      let nextValueNumber = Math.max(0, Math.min(59, parseInt(nextValue, 10)));
      secondsInputValue.value = String(nextValueNumber);
      if (twelveHourMode.value) {
        nextTick(() => {
          amPmInput.value?.focus();
        });
      }
    }
      break;
  }
};
const handleSecondsWheel = (e: WheelEvent) => {
  e.preventDefault();
  adjustSeconds(e.deltaY < 0 ? 1 : -1);
};

const handleAmPmWheel = (e: WheelEvent) => {
  e.preventDefault();
  isAm.value = !isAm.value;
};

watch(hours, newHours => {
  hoursInputValue.value = String(newHours).padStart(2, '0');
});
watch(minutes, newMinutes => {
  minutesInputValue.value = String(newMinutes).padStart(2, '0');
});
watch(seconds, newSeconds => {
  secondsInputValue.value = String(newSeconds).padStart(2, '0');
});
</script>

<template>
  <HtInput
    ref="hoursInput"
    v-model="hoursInputValuePadded"
    type="text"
    inputmode="numeric"
    maxlength="2"
    min="0"
    max="23"
    class="time-picker-input"
    @focus.passive="handleHoursFocused"
    @keydown="handleHoursKeydown"
    @wheel="handleHoursWheel"
    @blur.passive="handleHoursBlur"
  />
  <HtFormInputGroupSymbol>:</HtFormInputGroupSymbol>
  <HtInput
    ref="minutesInput"
    v-model="minutesInputValuePadded"
    type="text"
    inputmode="numeric"
    maxlength="2"
    :min="minMinutesValue"
    :max="maxMinutesValue"
    class="time-picker-input"
    @focus.passive="handleMinutesFocused"
    @keydown="handleMinutesKeydown"
    @wheel="handleMinutesWheel"
    @blur.passive="handleMinutesBlur"
  />
  <HtFormInputGroupSymbol>:</HtFormInputGroupSymbol>
  <HtInput
    ref="secondsInput"
    v-model="secondsInputValuePadded"
    type="text"
    inputmode="numeric"
    maxlength="2"
    :min="minSecondsValue"
    :max="maxSecondsValue"
    class="time-picker-input"
    @focus.passive="handleSecondsFocused"
    @keydown="handleSecondsKeydown"
    @wheel="handleSecondsWheel"
    @blur.passive="handleSecondsBlur"
  />
  <HtFormSelect
    v-if="twelveHourMode && dtl"
    ref="amPmInput"
    v-model="isAm"
    @keydown="handleAmPmSelectKeydown"
    @wheel="handleAmPmWheel"
  >
    <option :value="true">
      {{ dtl.getMeridiemLabel(true, minutes) }}
    </option>
    <option :value="false">
      {{ dtl.getMeridiemLabel(false, minutes) }}
    </option>
  </HtFormSelect>
</template>

<style lang="scss" scoped>
.time-picker-input {
  text-align: center;
}
</style>
