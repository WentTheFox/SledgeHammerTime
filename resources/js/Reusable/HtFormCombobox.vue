<script setup lang="ts">
import { useTimezoneIndex } from '@/composables/useTimezoneIndex';
import { formControlId } from '@/injection-keys';
import HtFormComboboxSuggestion from '@/Reusable/HtFormComboboxSuggestion.vue';
import { ComboboxAddonComponentProps, ComboboxOption, suggestionItemClass } from '@/utils/combobox';
import { faChevronDown, faChevronUp, faKeyboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import {
  Component,
  computed,
  inject,
  nextTick,
  onMounted,
  onUnmounted,
  ref,
  toRef,
  useTemplateRef,
  watch,
} from 'vue';

const id = inject(formControlId);
const model = defineModel<string | null>({ default: null });

const props = withDefaults(defineProps<{
  options: ComboboxOption[];
  name?: string;
  class?: string;
  tabindex?: number | string;
  addonComponent?: Component<ComboboxAddonComponentProps>;
  allowTyping?: boolean;
}>(), {
  name: undefined,
  class: undefined,
  tabindex: undefined,
  addonComponent: undefined,
  allowTyping: true,
});

const emit = defineEmits<{
  (e: 'change', option: ComboboxOption): void;
  (e: 'focus', ev: FocusEvent): void
}>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');
const suggestionsRef = useTemplateRef<HTMLInputElement>('suggestions-el');
const inputValue = ref<string>('');
const typingModeValue = ref<string | null>(null);
const typingModeSelectionStart = ref<number>(0);
const typingModeSelectionEnd = ref<number>(0);
const highlightedIndex = ref<number>(-1);
const mode = ref<'typing' | 'select'>('typing');
const showSuggestions = ref<boolean>(false);
const isInteractingWithSuggestions = ref(false);
const newlyFocused = ref(false);
const freshlyFocusedTimeout = ref<ReturnType<typeof setTimeout> | null>(null);

type OptionMeta = { [k in keyof Omit<ComboboxOption, 'value'>]: Record<string, ComboboxOption[k]> };

const timezoneIndex = useTimezoneIndex(toRef(() => props.options));
const optionMeta = computed(() => props.options.reduce((acc: OptionMeta, option) => ({
  ...acc,
  label: {
    ...acc.label,
    [option.value]: option.label,
  },
  aliases: option.aliases ? { ...acc.aliases, [option.value]: option.aliases } : acc.aliases,
}), { label: {}, aliases: {} }));
const filteredOptions = computed<ComboboxOption[]>(() => {
  const normalizedInputValue = (mode.value === 'select' ? (typingModeValue.value ?? '') : inputValue.value).trim();
  return normalizedInputValue
    ? timezoneIndex.find.value(normalizedInputValue).map(value => ({
      value,
      label: optionMeta.value.label[value],
      aliases: optionMeta.value.aliases?.[value],
    }))
    : props.options;
});
const optionMatchingInputIndex = computed<number>(() =>
  filteredOptions.value.findIndex(option => option.label === inputValue.value),
);
const inputMatchesOption = computed<boolean>(() => optionMatchingInputIndex.value !== -1);
const visibleEntries = ref(new Set<string>());

const suggestionIO = computed(() => suggestionsRef.value ? new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    const entryValue = String((entry.target as HTMLElement).dataset.value);

    if (entry.isIntersecting) {
      visibleEntries.value.add(entryValue);
    } else {
      visibleEntries.value.delete(entryValue);
    }
  });
}, {
  root: suggestionsRef.value,
  threshold: 0.2,
}) : null);

const scrollHighlightedOptionIntoView = () => {
  nextTick(() => {
    if (!suggestionsRef.value) {
      return;
    }
    const targetSuggestion = suggestionsRef.value.children[highlightedIndex.value] as HTMLElement;
    if (!targetSuggestion || !targetSuggestion.offsetParent) return;

    const parentHeightHalf = targetSuggestion.offsetParent.getBoundingClientRect().height / 2;
    const targetOffsetHeightHalf = targetSuggestion.offsetHeight / 2;
    targetSuggestion.offsetParent.scrollTo(0, Math.max(0, targetSuggestion.offsetTop - parentHeightHalf + targetOffsetHeightHalf));
  });
};
const setInputValueFromModelValue = (newModelValue: string | null) => {
  inputValue.value = props.options.find(opt => opt.value === newModelValue)?.label ?? '';
  detectSelectMode();
};

const setTypingMode = ({ newInputValue, newTypingModeValue }: {
  newInputValue?: string,
  newTypingModeValue?: string
}) => {
  if (!props.allowTyping) {
    return;
  }
  mode.value = 'typing';
  if (typeof newInputValue !== 'undefined') {
    inputValue.value = newInputValue;
  }
  if (typeof newTypingModeValue !== 'undefined') {
    typingModeValue.value = newTypingModeValue;
  }
  highlightedIndex.value = -1;
};

// Detect manual user input & show suggestions
const handleInput = (e: Event) => {
  if (!props.allowTyping) {
    e.preventDefault();
    return;
  }

  if (mode.value === 'select') {
    setTypingMode({ newTypingModeValue: inputValue.value });
  }
  showSuggestions.value = true;
};

const isModifiedKeyboardEvent = (event: KeyboardEvent) =>
  isModifiedKeyboardEventWithoutShift(event) || event.shiftKey;

const isModifiedKeyboardEventWithoutShift = (event: KeyboardEvent) =>
  event.altKey || event.ctrlKey || event.metaKey;

const handleKeyDown = (event: KeyboardEvent) => {
  switch (event.key) {
    case 'Home':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
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
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (inputMatchesOption.value) {
        showSuggestions.value = true; // Show suggestions only if input matches an option
        event.preventDefault();
      }
      break;

    case 'ArrowDown':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (mode.value === 'typing' && filteredOptions.value.length > 0) {
        typingModeValue.value = inputValue.value;
        typingModeSelectionStart.value = inputRef.value?.selectionStart ?? 0;
        typingModeSelectionEnd.value = inputRef.value?.selectionStart ?? 0;
        highlightedIndex.value = optionMatchingInputIndex.value === -1
          ? 0
          : optionMatchingInputIndex.value;
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
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
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
      if (event.key === 'Tab' ? isModifiedKeyboardEventWithoutShift(event) : isModifiedKeyboardEvent(event)) {
        return;
      }
      if (event.key === 'Enter') {
        event.preventDefault();
      }
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
      break;

    case "PageDown":
    case "PageUp":
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      if (mode.value === 'select' && showSuggestions.value) {
        const suggestionsRefValue = suggestionsRef.value;
        if (!suggestionsRefValue || !suggestionsRefValue.offsetParent) {
          return;
        }
        event.preventDefault();

        const scrollAmount = suggestionsRefValue.getBoundingClientRect().height / 2;
        const scrollDirection = event.key === 'PageDown' ? 1 : -1;
        suggestionsRefValue.scrollTop += scrollAmount * scrollDirection;

        nextTick(() => {
          const children = Array.from(suggestionsRefValue.children) as HTMLElement[];
          const containerRect = suggestionsRefValue.getBoundingClientRect();
          let firstVisible: HTMLElement | null = null;
          for (let i = scrollDirection > 0 ? children.length - 1 : 0; scrollDirection > 0 ? i > -1 : i < children.length; i -= scrollDirection) {
            const child = children[i];
            const rect = child.getBoundingClientRect();
            const visible = rect.bottom <= containerRect.bottom && rect.top >= containerRect.top;
            if (visible) {
              firstVisible = child;
              break;
            }
          }
          if (firstVisible) {
            highlightedIndex.value = children.indexOf(firstVisible);
            inputValue.value = filteredOptions.value[highlightedIndex.value].label;
            scrollHighlightedOptionIntoView();
          }
        });
      }
      break;

    case 'Escape':
      if (isModifiedKeyboardEvent(event)) {
        return;
      }
      event.preventDefault();
      if (mode.value === 'select' && typingModeValue.value !== null) {
        if (!inputMatchesOption.value) {
          setTypingMode({ newInputValue: typingModeValue.value });
        }
      } else {
        highlightedIndex.value = optionMatchingInputIndex.value;
        setInputValueFromModelValue(model.value);
      }
      showSuggestions.value = false;
      break;
  }

  if (!props.allowTyping && !event.defaultPrevented) {
    event.preventDefault();
  }
};

const handleSuggestionClick = (option: ComboboxOption, index: number) => {
  inputValue.value = option.label;
  model.value = option.value;
  highlightedIndex.value = index;
  emit('change', option);
  showSuggestions.value = false;
  detectSelectMode();
};

// Handle focus & blur correctly
const handleFocus = (event: FocusEvent) => {
  emit('focus', event);
  if (!props.allowTyping) {
    showSuggestions.value = true;
  } else if (!isInteractingWithSuggestions.value) {
    showSuggestions.value = false; // Prevent showing suggestions immediately
  }
  detectSelectMode();
  newlyFocused.value = true;
  // Prevent handling click event shortly after focus
  freshlyFocusedTimeout.value = setTimeout(() => {
    newlyFocused.value = false;
    freshlyFocusedTimeout.value = null;
  }, 50);
};
const handleInputClick = () => {
  if (props.allowTyping || newlyFocused.value) {
    return;
  }
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
  // Check if focus is moving to a suggestion
  const relatedTarget = event.relatedTarget as HTMLElement | null;
  if (relatedTarget) {
    if (isInteractingWithSuggestions.value) {
      return;
    }
    const targetClasses = relatedTarget.classList;
    if (targetClasses.contains(suggestionItemClass) || targetClasses.contains(formSelectIconClass)) {
      return;
    }
  }
  showSuggestions.value = false;
  if (!inputMatchesOption.value) {
    setInputValueFromModelValue(model.value);
  }
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

defineExpose<FormComboboxApi>({
  focus,
});

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
      // Select the first option if no matching option is provided
      model.value = props.options?.[0].value ?? null;
    }
  }
});
onUnmounted(() => {
  if (document) {
    document.body.removeEventListener('mouseup', globalMouseupHandler);
  }
  suggestionIO.value?.disconnect();
  if (freshlyFocusedTimeout.value) {
    clearTimeout(freshlyFocusedTimeout.value);
  }
});

watch(model, (newModelValue) => {
  setInputValueFromModelValue(newModelValue);
}, { immediate: true });
</script>

<template>
  <div :class="['form-control-combobox form-control-select', {'suggestions-open': showSuggestions, 'has-suggestions': filteredOptions.length > 0, 'allow-typing': allowTyping}]">
    <input
      :id="id"
      ref="input-el"
      v-model="inputValue"
      :name="props.name"
      :class="['form-select-input input-field', props.class, { 'hide-selection': !allowTyping }]"
      :tabindex="props.tabindex"
      autocomplete="off"
      :readonly="!allowTyping"
      @keydown="handleKeyDown"
      @input="handleInput"
      @focus="handleFocus"
      @blur="handleBlur"
      @click="handleInputClick"
    >
    <button
      type="button"
      :class="[formSelectIconClass, { [clickableClass]: mode === 'select' }]"
      tabindex="-1"
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
      ref="suggestions-el"
      class="combobox-suggestions"
      @mousedown.passive="handleMouseDown"
    >
      <HtFormComboboxSuggestion
        v-for="(option, i) in filteredOptions"
        :key="option.value"
        :option="option"
        :selected-option="model"
        :is-highlighted="highlightedIndex === i"
        :is-visible="visibleEntries.has(option.value)"
        :intersection-observer="suggestionIO"
        :addon-component="addonComponent"
        :input-value="mode === 'typing' ? inputValue : typingModeValue"
        @click.passive="handleSuggestionClick(option, i)"
        @mouseenter.passive="highlightedIndex = i"
        @scroll-to-selected="scrollHighlightedOptionIntoView"
      />
    </div>
  </div>
</template>
