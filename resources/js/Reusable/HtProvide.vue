<script setup lang="ts">
import { provide } from 'vue';

const props = defineProps<{
  injectionKey: unknown,
  value: unknown
}>();

provide(props.injectionKey, props.value);
</script>

<template>
  <slot />
</template>
