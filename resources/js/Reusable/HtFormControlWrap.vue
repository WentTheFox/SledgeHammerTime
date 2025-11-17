<script setup lang="ts">
withDefaults(defineProps<{
  comboBox?: boolean,
  disabled?: boolean,
}>(), {
  comboBox: false,
  disabled: false,
});
</script>

<template>
  <div :class="['form-control-wrap', { 'combo-box': comboBox, disabled }]">
    <slot />
  </div>
</template>
