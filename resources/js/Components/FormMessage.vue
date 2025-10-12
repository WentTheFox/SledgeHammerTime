<script setup lang="ts">
const props = defineProps<{
  type?: 'error' | 'success';
  'class'?: string;
  message?: string;
}>();
</script>

<template>
  <p
    v-show="message"
    :class="['form-message', type, props.class]"
  >
    {{ message }}
  </p>
</template>
