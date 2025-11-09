<script setup lang="ts">
import { BadgeColor } from '@/utils/badges';

import { useSlots } from 'vue';

const props = defineProps<{
  prefix?: string;
  suffix?: string;
  class?: string;
  title?: string;
  color?: BadgeColor;
}>();
const slots = useSlots();
</script>

<template>
  <span
    :class="['badge', { [`badge-${color}`]: color }, props.class]"
    :title="title"
  >
    <span
      v-if="prefix || slots.prefix"
      class="badge-prefix"
    >
      <template v-if="prefix">{{ prefix }}</template>
      <slot name="prefix" />
    </span>
    <span class="badge-content"><slot /></span>
    <span
      v-if="suffix || slots.suffix"
      class="badge-suffix"
    >
      <template v-if="suffix">{{ suffix }}</template>
      <slot name="suffix" />
    </span>
  </span>
</template>
