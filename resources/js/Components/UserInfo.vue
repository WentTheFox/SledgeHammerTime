<script setup lang="ts">
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import { useId } from 'vue';
import { Tippy } from 'vue-tippy';

const props = defineProps<{
  class: string;
  name: string;
  avatarUrl: string;
  service: string;
  stale: boolean | undefined;
  avatarOnly?: boolean;
}>();

const id = useId();
</script>

<template>
  <figure :class="['user-info', props.class]">
    <span
      :id="id"
      class="user-image-wrap"
    >
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
    <Tippy
      v-if="avatarOnly"
      :content="name"
      :inline-positioning="true"
      :to="id"
    />
    <slot v-if="!avatarOnly" />
  </figure>
</template>
