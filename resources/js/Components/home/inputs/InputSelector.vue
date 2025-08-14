<script setup lang="ts">
import type { Component } from 'vue';

export type InputSelectorImplProps = { disabled?: boolean };

defineProps<InputSelectorImplProps & {
  customInputEnabled: boolean | null | undefined;
  customImpl: Component<InputSelectorImplProps>;
  nativeImpl: Component<InputSelectorImplProps>;
}>();
</script>

<template>
  <component
    :is="customInputEnabled ? customImpl : nativeImpl"
    :disabled="disabled"
  />
</template>

<style scoped>

</style>
