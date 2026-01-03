<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { chronoInject, formControlId, timestampInject } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { wTrans } from 'laravel-vue-i18n';
import { inject, ref, useTemplateRef, watch } from 'vue';
import { refThrottled } from '@vueuse/core';

const ts = inject(timestampInject);
const id = inject(formControlId);
const chrono = inject(chronoInject);
const nlpInput = useTemplateRef<InputApi | null>('nlpInput');

const inputValue = ref('');
const inputValueThrottled = refThrottled(inputValue, 600);

const getParsedValue = (value: string, currentTimestamp: DateTimeLibraryValue | null) => (
  chrono?.value?.parseDate(value, currentTimestamp?.toDate(), { forwardDate: true }) ?? null
);

const handleInputBlur = () => {
  nlpInput.value?.reportValidity();
};

const naturalLanguageParseError = wTrans('timestampPicker.picker.validation.naturalLanguageParseError');

watch([inputValueThrottled, ts!.currentTimestampDirect], ([newInputValue, currentTimestamp]) => {
  const trimmedInputValue = newInputValue.trim();
  const newParsedValue = getParsedValue(trimmedInputValue, currentTimestamp);
  if (newParsedValue === null && trimmedInputValue.length > 0) {
    nlpInput.value?.setCustomValidity(naturalLanguageParseError.value);
  } else {
    nlpInput.value?.setCustomValidity('');
  }
  ts!.setNlpDate(newParsedValue);
});
</script>

<template>
  <div>
    <HtInput
      :id="id"
      ref="nlpInput"
      v-model="inputValue"
      type="text"
      :disabled="!chrono"
      @blur.passive="handleInputBlur"
    />
  </div>
</template>
