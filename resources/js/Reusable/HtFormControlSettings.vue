<script setup lang="ts">
import {
  formControlDisabledInject,
  formControlFullWidthInject,
  formControlIdInject,
} from '@/injection-keys';
import { computed, provide } from 'vue';

defineOptions({ inheritAttrs: false });

const props = withDefaults(defineProps<{
  id?: string;
  disabled?: boolean;
  fullWidth?: boolean;
}>(), {
  id: undefined,
  disabled: undefined,
  fullWidth: undefined,
});

provide(formControlIdInject, computed(() => props.id));
provide(formControlDisabledInject, computed(() => props.disabled));
provide(formControlFullWidthInject, computed(() => props.fullWidth));
</script>

<template>
  <slot />
</template>
