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

const handleHoursFocused = () => {
  dial.value?.setMode(DialMode.Hours);
  hoursInput.value?.select();
};
const handleMinutesFocused = () => {
  dial.value?.setMode(DialMode.Minutes);
  minutesInput.value?.select();
};
const handleSecondsFocused = () => {
  dial.value?.setMode(DialMode.Seconds);
  secondsInput.value?.select();
};

/** Not for use in the template */
const _handleTwentyFourHoursBlur = inputRangeLimitBlurHandlerFactory(hours);
const handleHoursBlur = (e: FocusEvent) => {
  if (!twelveHourMode.value) {
    _handleTwentyFourHoursBlur(e);
    return;
  }

  const result = coerceToTwelveHours(hours.value);
  if (!result) return;

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

const handleHoursKeydown = (e: Event) => {
  if (!(e instanceof KeyboardEvent) || e.key === 'Tab') return;
  e.preventDefault();
  if (!/^\d$/.test(e.key)) {
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
const handleMinutesKeydown = (e: Event) => {
  if (!(e instanceof KeyboardEvent) || e.key === 'Tab') return;
  e.preventDefault();
  if (!/^\d$/.test(e.key)) {
    e.preventDefault();
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
const handleSecondsKeydown = (e: Event) => {
  if (!(e instanceof KeyboardEvent) || e.key === 'Tab') return;
  e.preventDefault();
  if (!/^\d$/.test(e.key)) {
    e.preventDefault();
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
    @blur.passive="handleHoursBlur"
  />
  <HtFormInputGroupSymbol>:</HtFormInputGroupSymbol>
  <HtInput
    ref="minutesInput"
    v-model="minutesInputValuePadded"
    type="text"
    inputmode="numeric"
    maxlength="2"
    min="0"
    max="59"
    class="time-picker-input"
    @focus.passive="handleMinutesFocused"
    @keydown="handleMinutesKeydown"
    @blur.passive="handleMinutesBlur"
  />
  <HtFormInputGroupSymbol>:</HtFormInputGroupSymbol>
  <HtInput
    ref="secondsInput"
    v-model="secondsInputValuePadded"
    type="text"
    inputmode="numeric"
    maxlength="2"
    min="0"
    max="59"
    class="time-picker-input"
    @focus.passive="handleSecondsFocused"
    @keydown="handleSecondsKeydown"
    @blur.passive="handleSecondsBlur"
  />
  <HtFormSelect
    v-if="twelveHourMode && dtl"
    ref="amPmInput"
    v-model="isAm"
    @keydown="handleAmPmSelectKeydown"
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
