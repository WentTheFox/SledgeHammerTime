<script setup lang="ts">
import { useFormControlDisabled } from '@/composables/useFormControlDisabled';
import { useFormControlFullWidth } from '@/composables/useFormControlFullWidth';

const disabled = useFormControlDisabled();
const fullWidth = useFormControlFullWidth();
</script>

<template>
  <div :class="['form-control-wrap', { disabled, 'full-width': fullWidth }]">
    <slot />
  </div>
</template>
