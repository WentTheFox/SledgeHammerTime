<script setup lang="ts">
import { useSlots } from 'vue';

const props = defineProps<{
  class?: string;
  halfSize?: boolean;
  id?: string;
}>();

const slots = useSlots();
</script>

<template>
  <article
    :id="id"
    :class="['card', { 'half-size': halfSize }, props.class]"
  >
    <header
      v-if="slots.header"
      class="card-header"
    >
      <slot name="header" />
    </header>
    <slot />
  </article>
</template>
