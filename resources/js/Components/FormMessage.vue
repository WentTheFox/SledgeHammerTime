<script setup lang="ts">
import { useFormControlId } from '@/composables/useFormControlId';
import { computed, useSlots } from 'vue';

const props = defineProps<{
  type?: 'error' | 'success' | 'description';
  'class'?: string;
  message?: string;
}>();

const slots = useSlots();
const formControlId = useFormControlId();
const description = computed(() => props.type === 'description');
</script>

<template>
  <p
    v-show="message || slots.message"
    :id="description ? `${formControlId}-description` : undefined"
    :class="['form-message', `form-message-${type}`, props.class]"
  >
    <template v-if="message">
      {{ message }}
    </template>
    <slot name="message" />
  </p>
</template>
