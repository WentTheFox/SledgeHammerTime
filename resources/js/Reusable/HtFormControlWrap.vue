<script setup lang="ts">
import { useFormControlDisabled } from '@/composables/useFormControlDisabled';
import { useFormControlFullWidth } from '@/composables/useFormControlFullWidth';

defineProps<{
  hasCombobox?: boolean;
}>();

const disabled = useFormControlDisabled();
const fullWidth = useFormControlFullWidth();
</script>

<template>
  <div :class="['form-control-wrap', { disabled, 'full-width': fullWidth, 'has-combobox': hasCombobox }]">
    <slot />
  </div>
</template>
