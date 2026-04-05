<script setup lang="ts">
import HtProgressBar, { ProgressBarProps } from '@/Reusable/HtProgressBar.vue';

const props = withDefaults(defineProps<{
  bars: ProgressBarProps[];
  min?: number;
  max?: number;
  class?: string;
}>(), {
  min: 0,
  max: 100,
  class: undefined,
});

const maxProgress = Math.max(...props.bars.map(bar => bar.progress), 0);
</script>

<template>
  <div
    :class="['progress', props.class]"
    role="progressbar"
    :aria-valuemax="max"
    :aria-valuemin="min"
    :aria-valuenow="maxProgress"
  >
    <HtProgressBar
      v-for="(bar, i) in bars"
      :key="i"
      :progress="bar.progress"
      :color="bar.color"
    />
  </div>
</template>

<style scoped lang="scss">
@use "../../css/design";

.progress {
  display: block;
  width: 100%;
  height: design.app-value('progress-bar-height');
  border-radius: calc(#{design.app-value('progress-bar-height')} * 0.5);
  background-color: design.app-color('button-default-bg');
  border: 1px solid design.app-color('button-default-border-color');
  position: relative;
}
</style>
