<script setup lang="ts">
import { formControlIdInject } from '@/injection-keys';
import { computed, provide } from 'vue';

const props = defineProps<{
  id: string,
}>();

const formControlId = computed(() => props.id);
provide(formControlIdInject, formControlId);
</script>

<template>
  <slot />
</template>
