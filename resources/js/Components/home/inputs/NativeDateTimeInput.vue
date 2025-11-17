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
      :disabled="disabled"
      @change="changeDateTime"
    />
  </div>
</template>
