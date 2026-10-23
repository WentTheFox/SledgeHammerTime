<script setup lang="ts">
import { accordionInject } from '@/Reusable/accordion-context';
import { computed, provide } from 'vue';

const props = withDefaults(defineProps<{
  /**
   * Whether opening an item leaves the ones that are open as they are. Without it opening one closes the others.
   */
  multiple?: boolean;
  class?: string;
}>(), {
  multiple: false,
  class: undefined,
});

/**
 * The ids of the items that are open. Optional to bind: without a v-model the accordion keeps track of it on its own.
 */
const open = defineModel<string[]>('open', { default: () => [] });

const openIds = computed(() => open.value);

provide(accordionInject, {
  openIds,
  isOpen: id => open.value.includes(id),
  toggle: (id) => {
    if (open.value.includes(id)) {
      open.value = open.value.filter(openId => openId !== id);
    } else {
      open.value = props.multiple ? [...open.value, id] : [id];
    }
  },
});
</script>

<template>
  <div :class="['accordion', props.class]">
    <slot />
  </div>
</template>
