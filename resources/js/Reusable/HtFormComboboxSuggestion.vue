<script setup lang="ts">
import HtTextHighlighter from '@/Reusable/HtTextHighlighter.vue';
import { ComboboxOption, highlightedClass, selectedClass, suggestionItemClass } from '@/utils/combobox';
import { Component as ComponentType, onMounted, onUnmounted, useTemplateRef, watch } from 'vue';

const props = defineProps<{
  option: ComboboxOption;
  inputValue: string | null;
  selectedOption?: string;
  isHighlighted: boolean;
  isVisible: boolean;
  intersectionObserver: IntersectionObserver | null;
  addonComponent?: ComponentType<{ option: ComboboxOption }>;
}>();

const emit = defineEmits<{
  (e: 'click', option: ComboboxOption): void;
  (e: 'scrollToSelected'): void;
}>();

const suggestionRef = useTemplateRef('suggestion');

onMounted(() => {
  if (props.selectedOption === props.option.value) {
    emit('scrollToSelected');
  }
  if (suggestionRef.value) {
    props.intersectionObserver?.observe(suggestionRef.value);
  }
});

watch(() => props.intersectionObserver, (suggestionIO) => {
  if (suggestionRef.value) {
    suggestionIO?.observe(suggestionRef.value);
  }
});

onUnmounted(() => {
  if (suggestionRef.value) {
    props.intersectionObserver?.unobserve(suggestionRef.value);
  }
});
</script>

<template>
  <button
    ref="suggestion"
    :class="[suggestionItemClass, {[selectedClass]: option.value === selectedOption, [highlightedClass]: isHighlighted}]"
    type="button"
    :data-value="option.value"
    @click.prevent="emit('click', option)"
  >
    <span class="combobox-suggestion-item-text">
      <HtTextHighlighter
        :text="option.label"
        :query="inputValue"
      />
    </span>
    <span
      v-if="isVisible && addonComponent"
      class="combobox-suggestion-item-addon"
    >
      <component
        :is="addonComponent"
        :option="option"
      />
    </span>
  </button>
</template>
