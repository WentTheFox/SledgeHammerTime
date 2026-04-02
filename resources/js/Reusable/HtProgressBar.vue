<script setup lang="ts">
export interface ProgressBarProps {
  progress: number;
  color?: 'approval' | 'translation';
}

defineProps<ProgressBarProps>();
</script>

<template>
  <div
    :class="['progress-bar', { [`progress-bar-${color}`]: color }]"
    :style="`width: ${progress}%`"
  />
</template>

<style scoped lang="scss">
@use "../../css/design";

.progress-bar {
  height: 100%;
  border-radius: inherit;
  background-color: currentColor;
  position: absolute;
  top: 0;
  left: 0;

  &-approval {
    background-color: design.app-color('progress-bar-approval');
  }

  &-translation {
    background-color: design.app-color('progress-bar-translation');
  }
}
</style>
