<script setup lang="ts">
import { computed, useTemplateRef } from 'vue';

const props = withDefaults(defineProps<{
  name: string;
  value: string;
  current: boolean;
  selected: boolean;
  faded?: boolean;
  class?: string;
  navigationOnly?: 'top' | 'bottom';
}>(), {
  faded: false,
  navigationOnly: undefined,
  class: undefined,
});

const emit = defineEmits<{
  (e: 'click'): void;
  (e: 'switch-context'): void;
  (e: 'focus', id: string): void;
}>();

const labelRef = useTemplateRef<HTMLLabelElement>('labelRef');

const inputId = computed(() => `calendar-button-${props.name}-${props.value}`);

const findElementIndex = (el: HTMLElement) => {
  const parentChildren = el.parentElement?.children;
  if (parentChildren) {
    for (let elementIndex = 0; elementIndex < parentChildren?.length; elementIndex++) {
      if (parentChildren[elementIndex] === el) {
        return elementIndex;
      }
    }
  }
  return -1;
};

const moveFocusToNextRow = (el: HTMLElement) => {
  const elementIndex = findElementIndex(el);
  const nextRowEl = el.parentElement?.nextElementSibling;
  if (!nextRowEl) return;

  moveFocusToInputIn(nextRowEl, elementIndex);
};

const moveFocusToPrevRow = (el: HTMLElement) => {
  const elementIndex = findElementIndex(el);
  const prevRowEl = el.parentElement?.previousElementSibling;
  if (!prevRowEl) return;

  moveFocusToInputIn(prevRowEl, elementIndex);
};

const moveFocusToInputIn = (rowEl: Element, elementIndex: number) => {
  const targetElementInRow = rowEl.children[elementIndex];
  if (!targetElementInRow) return;

  const targetInput = targetElementInRow.querySelector('input');
  if (!targetInput) return;

  targetInput.focus();
  targetInput.click();
};

const handleKeydown = (e: Event) => {
  if (!(e instanceof KeyboardEvent) || !labelRef.value) return;

  switch (e.key) {
    case 'ArrowUp':
      e.preventDefault();
      moveFocusToPrevRow(labelRef.value);
      break;
    case 'ArrowDown':
      e.preventDefault();
      moveFocusToNextRow(labelRef.value);
      break;
    case ' ':
    case 'Space':
      e.preventDefault();
      emit('switch-context');
      break;
  }
};
</script>

<template>
  <label
    ref="labelRef"
    class="calendar-button-label"
    :class="[props.class, { current, selected, faded, hidden: navigationOnly }]"
  >
    <input
      :id="inputId"
      type="radio"
      :name="name"
      :value="value"
      :checked="selected"
      @click.prevent.capture="emit('click')"
      @keydown="handleKeydown"
      @focus="emit('focus', inputId)"
    >
    <span class="calendar-button">
      <slot />
    </span>
  </label>
</template>

