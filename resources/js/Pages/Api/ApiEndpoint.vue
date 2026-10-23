<script setup lang="ts">
import HtBadge from '@/Reusable/HtBadge.vue';
import { BadgeColor } from '@/utils/badges';
import { HttpMethod } from '@/utils/openapi';

defineProps<{
  method: HttpMethod;
  path: string;
}>();

const methodColors: Record<HttpMethod, BadgeColor> = {
  get: 'green',
  post: 'blue',
  put: 'yellow',
  patch: 'yellow',
  delete: 'red',
};
</script>

<template>
  <span class="api-endpoint"><HtBadge :color="methodColors[method]">{{ method.toUpperCase() }}</HtBadge><code class="api-endpoint-path">{{ path }}</code></span>
</template>
