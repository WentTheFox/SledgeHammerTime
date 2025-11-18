<script setup lang="ts">
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';
import { useSlots } from 'vue';

defineProps<{
  id: string,
  label?: string,
  name?: string,
  value?: string,
  checked: boolean;
  disabled?: boolean;
}>();

const emit = defineEmits<{
  (e: 'change', event: Event): void;
}>();

const slots = useSlots();
</script>

<template>
  <HtFormCheckbox
    :id="id"
    :label="label"
    :disabled="disabled"
  >
    <template
      v-if="slots.label"
      #label
    >
      <slot name="label" />
    </template>
    <template #input>
      <input
        :id="id"
        type="checkbox"
        :checked="checked"
        :name="name"
        :value="value"
        :disabled="disabled"
        class="form-checkbox-input"
        @change="emit('change', $event)"
      >
    </template>
    <template #message>
      <slot name="message" />
    </template>
  </HtFormCheckbox>
</template>
