<script setup lang="ts">
import { formControlIdInject } from '@/injection-keys';
import { computed, provide } from 'vue';

const props = defineProps<{
  dir?: 'ltr' | 'rtl';
  class?: string;
  id?: string;
}>();

const formControlId = computed(() => props.id);

provide(formControlIdInject, formControlId);
</script>

<template>
  <fieldset
    :class="['form-input-group', props.class]"
    :dir="dir"
  >
    <slot />
  </fieldset>
</template>
