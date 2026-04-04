<script setup lang="ts">
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import HtTextHighlighter from '@/Reusable/HtTextHighlighter.vue';
import { BadgeColor } from '@/utils/badges';
import {
  ComboboxOption,
  FormComboboxSuggestionAddonMode,
  highlightedClass,
  selectedClass,
  suggestionItemClass,
} from '@/utils/combobox';
import {
  Component as ComponentType,
  computed,
  onMounted,
  onUnmounted,
  useTemplateRef,
  watch,
} from 'vue';

const props = defineProps<{
  option: ComboboxOption;
  inputValue: string | null;
  selectedOption: string | null;
  isHighlighted: boolean;
  isVisible: boolean;
  intersectionObserver: IntersectionObserver | null;
  addonComponent?: ComponentType<{ option: ComboboxOption }>;
  addonMode: FormComboboxSuggestionAddonMode;
}>();

const emit = defineEmits<{
  (e: 'click', option: ComboboxOption): void;
  (e: 'scrollToSelected'): void;
}>();

interface BadgeItem {
  text: string;
  color: BadgeColor | undefined;
}

const badges = computed<BadgeItem[] | undefined>(() => {
  const { description, aliases, currentAlias } = props.option;
  if (!description && !aliases?.length) return undefined;

  const sortedItems = aliases
    ? [...(description ? [description] : []), ...aliases].sort((a, b) => (b === currentAlias ? 1 : 0) - (a === currentAlias ? 1 : 0))
    : [];

  return sortedItems.map(alias => ({
    text: alias,
    color: alias === currentAlias ? 'cyan' as BadgeColor : undefined,
  }));
});

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
    :class="[suggestionItemClass, {[selectedClass]: option.value === selectedOption, [highlightedClass]: isHighlighted, [`addon-mode-${addonMode}`]: addonComponent}]"
    type="button"
    :data-value="option.value"
    @click.prevent="emit('click', option)"
  >
    <span class="combobox-suggestion-item-label">
      <span class="combobox-suggestion-item-text">
        <span class="combobox-suggestion-item-main-text">
          <HtTextHighlighter
            :text="option.label"
            :query="inputValue"
          />
        </span>
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
    </span>
    <HtBadgeGroup
      v-if="badges"
      :compact="true"
    >
      <HtBadge
        v-for="badge in badges"
        :key="badge.text"
        :color="badge.color"
      >
        <HtTextHighlighter
          :text="badge.text"
          :query="inputValue"
        />
      </HtBadge>
    </HtBadgeGroup>
  </button>
</template>
