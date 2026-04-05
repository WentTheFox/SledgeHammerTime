<script setup lang="ts">
import { useComboboxSuggestionList } from '@/composables/useComboboxSuggestionList';
import { ComboboxSearchIndex } from '@/composables/useComboboxIndex';
import { useFormControlDisabled } from '@/composables/useFormControlDisabled';
import { useFormControlFullWidth } from '@/composables/useFormControlFullWidth';
import { useFormControlId } from '@/composables/useFormControlId';
import HtFormComboboxSuggestion from '@/Reusable/HtFormComboboxSuggestion.vue';
import {
  ComboboxAddonComponentProps,
  ComboboxOption,
  FormComboboxSuggestionAddonMode,
  normalizeQueryValue,
  suggestionItemClass,
} from '@/utils/combobox';
import { faChevronDown, faChevronUp, faKeyboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import {
  Component,
  computed,
  nextTick,
  onMounted,
  onUnmounted,
  ref,
  toRef,
  useTemplateRef,
  watch,
} from 'vue';

const model = defineModel<string | null>({ default: null });

const props = withDefaults(defineProps<{
  options: ComboboxOption[];
  name?: string;
  class?: string;
  tabindex?: number | string;
  addonComponent?: Component<ComboboxAddonComponentProps>;
  addonMode?: FormComboboxSuggestionAddonMode;
  allowTyping?: boolean;
  disabled?: boolean;
  readonly?: boolean;
  fullWidth?: boolean;
  stickyHeaders?: boolean;
  searchIndex?: ComboboxSearchIndex;
}>(), {
  name: undefined,
  class: undefined,
  tabindex: undefined,
  addonComponent: undefined,
  addonMode: 'dynamic',
  allowTyping: true,
  fullWidth: undefined,
  disabled: undefined,
  readonly: false,
  stickyHeaders: false,
  searchIndex: undefined,
});

const id = useFormControlId();
const effectiveDisabled = useFormControlDisabled(props);
const effectiveFullWidth = useFormControlFullWidth(props);

const emit = defineEmits<{
  (e: 'change', option: ComboboxOption): void;
  (e: 'focus', ev: FocusEvent): void
}>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');
const inputValue = ref<string>('');
const typingModeValue = ref<string | null>(null);
const typingModeSelectionStart = ref<number>(0);
const typingModeSelectionEnd = ref<number>(0);
const highlightedIndex = ref<number>(-1);
const mode = ref<'typing' | 'select'>('typing');
const showSuggestions = ref<boolean>(false);
const isInteractingWithSuggestions = ref(false);

const optionsByValue = computed(() => new Map(props.options.map(option => [option.value, option])));
const normalizedInputValue = computed(() => (mode.value === 'select' ? (typingModeValue.value ?? '') : inputValue.value).trim());
const filteredOptions = computed<ComboboxOption[]>(() => {
  if (!normalizedInputValue.value) return props.options;
  if (props.searchIndex) {
    return props.searchIndex.find.value(normalizedInputValue.value)
      .map(value => optionsByValue.value.get(value)!)
      .filter(Boolean);
  }
  const query = normalizeQueryValue(normalizedInputValue.value);
  return props.options.filter(option => normalizeQueryValue(option.label).includes(query));
});

const optionMatchingInputIndex = computed<number>(() =>
  filteredOptions.value.findIndex(option => option.label === inputValue.value),
);
const inputMatchesOption = computed<boolean>(() => optionMatchingInputIndex.value !== -1);

const {
  containerRef,
  containerProps,
  wrapperProps,
  virtualItems,
  showStickyHeaderOverlay,
  currentStickyHeader,
  scrollHighlightedOptionIntoView,
  scrollByPage,
} = useComboboxSuggestionList({
  filteredOptions,
  highlightedIndex,
  showSuggestions,
  normalizedInputValue,
  stickyHeaders: toRef(() => props.stickyHeaders),
});

const setInputValueFromModelValue = (newModelValue: string | null) => {
  inputValue.value = (newModelValue !== null ? optionsByValue.value.get(newModelValue)?.label : undefined) ?? '';
  detectSelectMode();
};

const setTypingMode = ({ newInputValue, newTypingModeValue }: {
  newInputValue?: string,
  newTypingModeValue?: string
}) => {
  if (!props.allowTyping) return;
  mode.value = 'typing';
  if (typeof newInputValue !== 'undefined') inputValue.value = newInputValue;
  if (typeof newTypingModeValue !== 'undefined') typingModeValue.value = newTypingModeValue;
  highlightedIndex.value = -1;
};

const handleInput = (e: Event) => {
  if (!props.allowTyping) {
    e.preventDefault();
    return;
  }
  if (mode.value === 'select') setTypingMode({ newTypingModeValue: inputValue.value });
  showSuggestions.value = true;
};

const isModifiedKeyboardEvent = (event: KeyboardEvent) =>
  isModifiedKeyboardEventWithoutShift(event) || event.shiftKey;

const isModifiedKeyboardEventWithoutShift = (event: KeyboardEvent) =>
  event.altKey || event.ctrlKey || event.metaKey;

const handleKeyDown = (event: KeyboardEvent) => {
  switch (event.key) {
    case 'Home':
      if (isModifiedKeyboardEvent(event)) return;
      if (mode.value === 'select' && showSuggestions.value && filteredOptions.value.length > 0) {
        highlightedIndex.value = filteredOptions.value.length - 1;
      }
      break;
    case 'End':
      if (mode.value === 'select' && showSuggestions.value && filteredOptions.value.length > 0) {
        highlightedIndex.value = filteredOptions.value.length - 1;
      }
      break;

    case ' ':
      if (isModifiedKeyboardEvent(event)) return;
      if (inputMatchesOption.value) {
        showSuggestions.value = true;
        event.preventDefault();
      }
      break;

    case 'ArrowDown':
      if (isModifiedKeyboardEvent(event)) return;
      if (mode.value === 'typing' && filteredOptions.value.length > 0) {
        typingModeValue.value = inputValue.value;
        typingModeSelectionStart.value = inputRef.value?.selectionStart ?? 0;
        typingModeSelectionEnd.value = inputRef.value?.selectionStart ?? 0;
        highlightedIndex.value = optionMatchingInputIndex.value === -1 ? 0 : optionMatchingInputIndex.value;
        mode.value = 'select';
        inputValue.value = filteredOptions.value[0].label;
        showSuggestions.value = true;
        event.preventDefault();
      } else if (mode.value === 'select') {
        const currentIndex = highlightedIndex.value;
        if (currentIndex < filteredOptions.value.length - 1) {
          highlightedIndex.value = currentIndex + 1;
          inputValue.value = filteredOptions.value[highlightedIndex.value].label;
        }
        event.preventDefault();
      }
      scrollHighlightedOptionIntoView();
      break;

    case 'ArrowUp':
      if (isModifiedKeyboardEvent(event)) return;
      if (mode.value === 'select') {
        event.preventDefault();
        const currentIndex = highlightedIndex.value;
        if (currentIndex > 0) {
          highlightedIndex.value = currentIndex - 1;
          inputValue.value = filteredOptions.value[highlightedIndex.value].label;
          scrollHighlightedOptionIntoView();
        } else {
          if (typingModeValue.value !== null) {
            setTypingMode({ newInputValue: typingModeValue.value });
            if (inputRef.value) {
              inputRef.value.selectionStart = typingModeSelectionStart.value;
              inputRef.value.selectionEnd = typingModeSelectionEnd.value;
            }
          } else {
            setInputValueFromModelValue(model.value);
          }
          highlightedIndex.value = -1;
        }
      }
      break;

    case 'Enter':
    case 'Tab':
      if (event.key === 'Tab' ? isModifiedKeyboardEventWithoutShift(event) : isModifiedKeyboardEvent(event)) return;
      if (event.key === 'Enter') event.preventDefault();
      if (mode.value === 'select' && showSuggestions.value && highlightedIndex.value !== -1) {
        const selectedOption = filteredOptions.value[highlightedIndex.value];
        if (selectedOption) {
          model.value = selectedOption.value;
          inputValue.value = selectedOption.label;
          typingModeValue.value = '';
          emit('change', selectedOption);
        }
      } else {
        highlightedIndex.value = optionMatchingInputIndex.value;
        mode.value = highlightedIndex.value !== -1 ? 'select' : 'typing';
        setInputValueFromModelValue(model.value);
      }
      showSuggestions.value = false;
      return;

    case 'PageDown':
    case 'PageUp': {
      if (isModifiedKeyboardEvent(event)) return;
      if (mode.value === 'select' && showSuggestions.value) {
        const container = containerRef.value;
        if (!container || !container.offsetParent) break;
        event.preventDefault();
        const direction = (event.key === 'PageDown' ? 1 : -1) as 1 | -1;
        scrollByPage(direction).then(visibleValue => {
          if (!visibleValue) return;
          highlightedIndex.value = filteredOptions.value.findIndex(o => o.value === visibleValue);
          inputValue.value = filteredOptions.value[highlightedIndex.value].label;
          scrollHighlightedOptionIntoView();
        });
      }
      break;
    }

    case 'Escape':
      if (isModifiedKeyboardEvent(event)) return;
      event.preventDefault();
      if (mode.value === 'select' && typingModeValue.value !== null) {
        if (!inputMatchesOption.value) setTypingMode({ newInputValue: typingModeValue.value });
      } else {
        highlightedIndex.value = optionMatchingInputIndex.value;
        setInputValueFromModelValue(model.value);
      }
      showSuggestions.value = false;
      break;
  }

  if (!props.allowTyping && !event.defaultPrevented) event.preventDefault();
};

const handleSuggestionClick = (option: ComboboxOption, index: number) => {
  inputValue.value = option.label;
  model.value = option.value;
  highlightedIndex.value = index;
  emit('change', option);
  showSuggestions.value = false;
  detectSelectMode();
};

const handleFocus = (event: FocusEvent) => {
  emit('focus', event);
  if (props.allowTyping && !isInteractingWithSuggestions.value) {
    showSuggestions.value = false;
  }
  detectSelectMode();
};
const handleInputClick = () => {
  if (props.allowTyping) return;
  showSuggestions.value = !showSuggestions.value;
};
const detectSelectMode = () => {
  nextTick(() => {
    if (inputMatchesOption.value) {
      mode.value = 'select';
      typingModeValue.value = null;
      highlightedIndex.value = optionMatchingInputIndex.value;
    }
  });
};

const handleIconClick = (event: MouseEvent) => {
  event.preventDefault();
  event.stopPropagation();
  const currentShowSuggestionsValue = showSuggestions.value;
  inputRef.value?.focus();
  nextTick(() => {
    showSuggestions.value = !currentShowSuggestionsValue;
  });
};

const formSelectIconClass = 'form-select-icon';
const clickableClass = 'clickable';
const handleBlur = (event: FocusEvent) => {
  const relatedTarget = event.relatedTarget as HTMLElement | null;
  if (relatedTarget) {
    if (isInteractingWithSuggestions.value) return;
    const targetClasses = relatedTarget.classList;
    if (targetClasses.contains(suggestionItemClass) || targetClasses.contains(formSelectIconClass)) return;
  }
  showSuggestions.value = false;
  if (!inputMatchesOption.value) setInputValueFromModelValue(model.value);
};

const handleMouseDown = () => {
  isInteractingWithSuggestions.value = true;
};

const focus = () => {
  inputRef.value?.focus();
  inputRef.value?.select();
};

export interface FormComboboxApi {
  focus: typeof focus;
}

defineExpose<FormComboboxApi>({ focus });

const globalMouseupHandler = () => {
  if (isInteractingWithSuggestions.value && showSuggestions.value) {
    inputRef.value?.focus();
  }
  nextTick(() => {
    isInteractingWithSuggestions.value = false;
  });
};
onMounted(() => {
  if (document) {
    document.body.addEventListener('mouseup', globalMouseupHandler, { passive: true });
  }
  if (!props.allowTyping && mode.value === 'typing') {
    mode.value = 'select';
    if (!props.options.some(o => o.value === model.value)) {
      model.value = props.options?.[0].value ?? null;
    }
  }
});
onUnmounted(() => {
  if (document) {
    document.body.removeEventListener('mouseup', globalMouseupHandler);
  }
});

watch(model, (newModelValue) => {
  setInputValueFromModelValue(newModelValue);
}, { immediate: true });
</script>

<template>
  <div :class="[`form-control-combobox form-control-select addon-mode-${addonMode}`, {'suggestions-open': showSuggestions, 'has-suggestions': filteredOptions.length > 0, 'allow-typing': allowTyping, disabled: effectiveDisabled, 'full-width': effectiveFullWidth}]">
    <input
      :id="id"
      ref="input-el"
      v-model="inputValue"
      type="text"
      :name="props.name"
      :class="['form-select-input input-field', props.class, { 'hide-selection': !allowTyping, 'full-width': effectiveFullWidth }]"
      :tabindex="props.tabindex"
      autocomplete="off"
      :readonly="!allowTyping || readonly"
      :disabled="effectiveDisabled"
      @keydown="handleKeyDown"
      @input="handleInput"
      @focus="handleFocus"
      @blur="handleBlur"
      @click="handleInputClick"
    >
    <button
      type="button"
      :class="[formSelectIconClass, { [clickableClass]: mode === 'select' && !effectiveDisabled && !readonly }]"
      tabindex="-1"
      :disabled="effectiveDisabled || readonly"
      @click="handleIconClick"
      @mousedown="isInteractingWithSuggestions = true"
    >
      <FontAwesomeIcon
        :icon="mode === 'typing' ? faKeyboard : (showSuggestions ? faChevronUp : faChevronDown)"
        :fixed-width="true"
      />
    </button>
    <div
      v-if="showSuggestions && filteredOptions.length"
      v-bind="containerProps"
      class="combobox-suggestions"
      @mousedown.passive="handleMouseDown"
    >
      <div
        v-if="showStickyHeaderOverlay"
        ref="sticky-overlay-el"
        class="combobox-suggestion-header combobox-suggestion-header-overlay"
        aria-hidden="true"
      >
        {{ currentStickyHeader }}
      </div>
      <div v-bind="wrapperProps">
        <template
          v-for="virtualItem in virtualItems"
          :key="virtualItem.data.key"
        >
          <div
            v-if="virtualItem.data.type === 'header'"
            class="combobox-suggestion-header"
            aria-hidden="true"
          >
            {{ virtualItem.data.label }}
          </div>
          <HtFormComboboxSuggestion
            v-else
            :option="virtualItem.data.option"
            :display-label="virtualItem.data.displayLabel"
            :selected-option="model"
            :is-highlighted="highlightedIndex === virtualItem.data.index"
            :addon-component="addonComponent"
            :addon-mode="addonMode"
            :input-value="mode === 'typing' ? inputValue : typingModeValue"
            @click.passive="handleSuggestionClick(virtualItem.data.option, virtualItem.data.index)"
            @mouseenter.passive="highlightedIndex = virtualItem.data.index"
            @scroll-to-selected="scrollHighlightedOptionIntoView"
          />
        </template>
      </div>
    </div>
  </div>
</template>
