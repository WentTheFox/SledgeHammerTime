<script setup lang="ts">
const props = defineProps<{
  separated?: boolean;
  class?: string;
}>();
</script>

<template>
  <div :class="['button-group', props.class, { separated }]">
    <slot />
  </div>
</template>
