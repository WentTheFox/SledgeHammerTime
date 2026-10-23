<script setup lang="ts">
import { accordionInject } from '@/Reusable/accordion-context';
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import { faCaretDown, faCaretRight } from '@fortawesome/free-solid-svg-icons';
import { computed, inject } from 'vue';

const props = defineProps<{
  /**
   * Unique within the accordion
   */
  id: string;
  class?: string;
}>();

const accordion = inject(accordionInject);
if (!accordion) {
  throw new Error('HtAccordionItem has to be inside an HtAccordion');
}

const isOpen = computed(() => accordion.isOpen(props.id));
</script>

<template>
  <div :class="['accordion-item', props.class]">
    <HtButton
      class="accordion-item-toggle"
      :full-width="true"
      :allow-overflow="true"
      justify="start"
      :aria-expanded="isOpen"
      :pressed="isOpen"
      :icon-start="isOpen ? faCaretDown : faCaretRight"
      @click="accordion.toggle(id)"
    >
      <slot name="header" />
    </HtButton>
    <HtCollapsible
      :visible="isOpen"
      class="mt-0"
    >
      <div class="accordion-item-body">
        <slot />
      </div>
    </HtCollapsible>
  </div>
</template>
