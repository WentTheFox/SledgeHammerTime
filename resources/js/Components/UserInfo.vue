<script setup lang="ts">
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';

const props = defineProps<{
  class: string;
  name: string;
  avatarUrl: string;
  service: string;
  stale: boolean | undefined;
}>();
</script>

<template>
  <figure :class="['user-info', props.class]">
    <span class="user-image-wrap">
      <HtLoadingIndicator
        v-if="stale"
        size="100%"
      />
      <img
        :alt="`${service} avatar of ${name}`"
        :src="avatarUrl"
        class="user-image"
      >
    </span>
    <slot />
  </figure>
</template>
