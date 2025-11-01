<script setup lang="ts">
const props = defineProps<{
  class?: string;
  compact?: boolean
}>();
</script>

<template>
  <span :class="['badge-group', props.class, { compact }]">
    <slot />
  </span>
</template>
