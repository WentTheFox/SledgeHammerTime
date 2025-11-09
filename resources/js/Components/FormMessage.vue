<script setup lang="ts">
import { useSlots } from 'vue';

const props = defineProps<{
  type?: 'error' | 'success';
  'class'?: string;
  message?: string;
}>();

const slots = useSlots();
</script>

<template>
  <p
    v-show="message || slots.message"
    :class="['form-message', type, props.class]"
  >
    <template v-if="message">
      {{ message }}
    </template>
    <slot name="message" />
  </p>
</template>
