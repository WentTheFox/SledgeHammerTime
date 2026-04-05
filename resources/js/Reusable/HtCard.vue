<script setup lang="ts">
import { useSlots } from 'vue';

const props = defineProps<{
  class?: string;
  id?: string;
}>();

const slots = useSlots();
</script>

<template>
  <article
    :id="id"
    :class="['card', props.class]"
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
