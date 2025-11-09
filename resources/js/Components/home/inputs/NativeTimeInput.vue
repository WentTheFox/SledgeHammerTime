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

const selectedTime = ref('');

const changeTime = () => {
  ts?.changeTimeString(selectedTime.value);
};

watch(() => ts?.currentTime, (currentTime) => {
  if (!currentTime) {
    selectedTime.value = '';
    return;
  }

  selectedTime.value = currentTime.value;
}, { immediate: true });
</script>

<template>
  <div>
    <HtInput
      :id="id"
      v-model="selectedTime"
      type="time"
      :disabled="disabled"
      @change="changeTime"
    />
  </div>
</template>
