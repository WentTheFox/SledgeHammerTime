<script setup lang="ts">
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';

defineProps<{
  id: string,
  label: string,
  name?: string,
  checked: boolean;
  disabled?: boolean;
}>();

const emit = defineEmits<{
  (e: 'change', event: Event): void;
}>();
</script>

<template>
  <HtFormCheckbox
    :id="id"
    :label="label"
    :disabled="disabled"
  >
    <template #input>
      <input
        :id="id"
        type="checkbox"
        :checked="checked"
        :name="name"
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
