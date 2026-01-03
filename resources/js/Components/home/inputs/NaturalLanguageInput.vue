<script setup lang="ts">
import { chronoInject, formControlId, timestampInject } from '@/injection-keys';
import HtInput, { InputApi } from '@/Reusable/HtInput.vue';
import { wTrans } from 'laravel-vue-i18n';
import { inject, ref, useTemplateRef, watch } from 'vue';

const ts = inject(timestampInject);
const id = inject(formControlId);
const chrono = inject(chronoInject);
const nlpInput = useTemplateRef<InputApi | null>('nlpInput');

const inputValue = ref('');

const getParsedValue = (value: string) => (
  chrono?.value?.parseDate(value, ts!.currentTimestamp.value?.toDate(), { forwardDate: true }) ?? null
);

const handleInputBlur = () => {
  nlpInput.value?.reportValidity();
};

const naturalLanguageParseError = wTrans('timestampPicker.picker.validation.naturalLanguageParseError');

watch(inputValue, (newInputValue) => {
  const trimmedInputValue = newInputValue.trim();
  const newParsedValue = getParsedValue(trimmedInputValue);
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
