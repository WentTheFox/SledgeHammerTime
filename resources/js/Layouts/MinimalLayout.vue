<script setup lang="ts">
import { useLayout } from '@/composables/useLayout';
import { defaultLayoutProps, LayoutProps } from '@/injection-keys';

const props = withDefaults(defineProps<Partial<LayoutProps>>(), defaultLayoutProps);

useLayout(props);
</script>

<template>
  <slot />
</template>
