<script setup lang="ts">
import HtCard from '@/Reusable/HtCard.vue';
import { useSlots } from 'vue';

withDefaults(defineProps<{
  justifyCenter?: boolean;
}>(), {
  justifyCenter: false,
});

const slots = useSlots();
</script>

<template>
  <HtCard class="useful-links-card">
    <template
      v-if="slots.header"
      #header
    >
      <slot name="header" />
    </template>

    <div :class="['links', { 'justify-center': justifyCenter }]">
      <slot />
    </div>

    <slot name="footer" />
  </HtCard>
</template>
