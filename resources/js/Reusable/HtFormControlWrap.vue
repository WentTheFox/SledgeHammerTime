<script setup lang="ts">
withDefaults(defineProps<{
  comboBox?: boolean,
  disabled?: boolean,
  fullWidth?: boolean,
}>(), {
  comboBox: false,
  disabled: false,
  fullWidth: false,
});
</script>

<template>
  <div :class="['form-control-wrap', { 'combo-box': comboBox, disabled, 'full-width': fullWidth }]">
    <slot />
  </div>
</template>
