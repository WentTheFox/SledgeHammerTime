<script setup lang="ts">
import type { InputSelectorImplProps } from '@/Components/home/inputs/InputSelector.vue';
import { formControlId, timestampInject } from '@/injection-keys';
import HtInput from '@/Reusable/HtInput.vue';
import { inject, ref, watch } from 'vue';

withDefaults(defineProps<InputSelectorImplProps>(), {
  disabled: false,
});

const ts = inject(timestampInject);
const id = inject(formControlId);

const selectedDate = ref('');

const changeDate = () => {
  ts?.changeDateString(selectedDate.value);
};

watch(ts!.currentDate, (currentDate) => {
  if (!currentDate) {
    selectedDate.value = '';
    return;
  }

  selectedDate.value = currentDate;
}, { immediate: true });
</script>

<template>
  <div>
    <HtInput
      :id="id"
      v-model="selectedDate"
      type="date"
      :disabled="disabled"
      @change="changeDate"
    />
  </div>
</template>
