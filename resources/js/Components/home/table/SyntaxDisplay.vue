<script setup lang="ts">
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import { computed } from 'vue';

export interface SyntaxDisplayProps {
  unixTs: number | undefined;
  format?: string;
}

const props = defineProps<SyntaxDisplayProps>();

const data = computed(() => props.format ? `<t:${props.unixTs}:${props.format}>` : props.unixTs);
</script>

<template>
  <HtCopyableText :data="data" />
</template>
