<script setup lang="ts">
const props = defineProps<{
  class?: string;
}>();
</script>

<template>
  <span
    class="calendar-grid-header"
    :class="props.class"
  >
    <slot />
  </span>
</template>

