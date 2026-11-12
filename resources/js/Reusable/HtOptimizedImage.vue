<script setup lang="ts">
const props = defineProps<{
  src: string;
  class?: string;
  alt?: string;
}>();

const isProduction = import.meta.env.PROD;
</script>

<template>
  <picture>
    <source
      v-if="isProduction"
      :srcset="src + '.avif'"
      type="image/avif"
    >
    <source
      v-if="isProduction"
      :srcset="src + '.webp'"
      type="image/webp"
    >
    <img
      :class="props.class"
      :src="src"
      :alt="alt ?? ''"
    >
  </picture>
</template>
