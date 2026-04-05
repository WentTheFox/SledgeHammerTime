<script setup lang="ts">
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import HtTextHighlighter from '@/Reusable/HtTextHighlighter.vue';
import {
  AliasBadgeItem,
  buildAliasBadges,
  ComboboxOption,
  FormComboboxSuggestionAddonMode,
  highlightedClass,
  selectedClass,
  suggestionItemClass,
} from '@/utils/combobox';
import {
  Component as ComponentType,
  computed,
  getCurrentInstance,
  nextTick,
  onMounted,
  ref,
  useTemplateRef,
  watch,
} from 'vue';
import { directive as vTippy } from 'vue-tippy';

const props = defineProps<{
  option: ComboboxOption;
  displayLabel?: string;
  inputValue: string | null;
  selectedOption: string | null;
  isHighlighted: boolean;
  addonComponent?: ComponentType<{ option: ComboboxOption }>;
  addonMode: FormComboboxSuggestionAddonMode;
}>();

const emit = defineEmits<{
  (e: 'click', option: ComboboxOption): void;
  (e: 'scrollToSelected'): void;
}>();

const badges = computed<AliasBadgeItem[] | undefined>(() => buildAliasBadges(props.option));


const mainTextRef = useTemplateRef<HTMLElement>('main-text-el');
const instance = getCurrentInstance();
const isLabelTruncated = ref(false);

const checkTruncation = () => {
  const el = mainTextRef.value;
  isLabelTruncated.value = !!el && el.scrollWidth > el.clientWidth;
};

const getTooltipAppendTarget = () => {
  if (import.meta.env.SSR) return undefined;
  return instance?.proxy?.$el?.closest('dialog') ?? document.body;
};

onMounted(() => {
  if (props.selectedOption === props.option.value) {
    emit('scrollToSelected');
  }
  nextTick(checkTruncation);
});

watch(() => props.displayLabel ?? props.option.label, () => nextTick(checkTruncation));
</script>

<template>
  <button
    :class="[suggestionItemClass, {[selectedClass]: option.value === selectedOption, [highlightedClass]: isHighlighted, [`addon-mode-${addonMode}`]: addonComponent, 'label-truncated': isLabelTruncated}]"
    type="button"
    :data-value="option.value"
    @click.prevent="emit('click', option)"
  >
    <span class="combobox-suggestion-item-label">
      <span class="combobox-suggestion-item-text">
        <span
          ref="main-text-el"
          class="combobox-suggestion-item-main-text"
        >
          <HtTextHighlighter
            :text="displayLabel ?? option.label"
            :query="inputValue"
          />
        </span>
      </span>
      <span
        v-if="addonComponent"
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
      <template
        v-for="badge in badges"
        :key="badge.text"
      >
        <HtBadge
          v-if="badge.color"
          v-tippy="{ content: $t(badge.tooltipKey!), appendTo: getTooltipAppendTarget, placement: 'left' }"
          :color="badge.color"
          class="cursor-help"
        >
          <HtTextHighlighter
            :text="badge.text"
            :query="inputValue"
          />
        </HtBadge>
        <HtBadge
          v-else
          :color="badge.color"
        >
          <HtTextHighlighter
            :text="badge.text"
            :query="inputValue"
          />
        </HtBadge>
      </template>
    </HtBadgeGroup>
  </button>
</template>
