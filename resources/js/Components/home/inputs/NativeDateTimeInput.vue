<script setup lang="ts">
import type { InputSelectorImplProps } from '@/Components/home/inputs/InputSelector.vue';
import { useFormControlDisabled } from '@/composables/useFormControlDisabled';
import { useFormControlId } from '@/composables/useFormControlId';
import { timestampInject } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { inject, ref, watch } from 'vue';

const props = defineProps<InputSelectorImplProps>();

const ts = inject(timestampInject);
const id = useFormControlId();
const effectiveDisabled = useFormControlDisabled(props);

const selectedDateTime = ref('');

const changeDateTime = () => {
  ts?.changeDateTimeString(selectedDateTime.value);
};

const updateSelectedDateTime = () => {
  if (!ts?.currentDate?.value || !ts?.currentTime?.value) {
    selectedDateTime.value = '';
    return;
  }

  selectedDateTime.value = `${ts.currentDate.value}T${ts.currentTime.value}`;
};

watch(ts!.currentDate, () => {
  updateSelectedDateTime();
}, { immediate: true });
watch(ts!.currentTime, () => {
  updateSelectedDateTime();
}, { immediate: true });
</script>

<template>
  <div>
    <HtInput
      :id="id"
      v-model="selectedDateTime"
      type="datetime-local"
      :disabled="effectiveDisabled"
      step="1"
      @change="changeDateTime"
    />
  </div>
</template>
