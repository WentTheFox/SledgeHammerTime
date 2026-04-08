<script setup lang="ts">
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';

defineProps<{
  id?: string;
  name: string;
  avatarUrl: string;
  service: string;
  loading: boolean | undefined;
}>();
</script>

<template>
  <span
    :id="id"
    class="user-image-wrap"
  >
    <HtLoadingIndicator
      v-if="loading"
      size="100%"
    />
    <img
      :alt="`${service} avatar of ${name}`"
      :src="avatarUrl"
      class="user-image"
    >
  </span>
</template>
