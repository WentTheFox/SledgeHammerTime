<script setup lang="ts">

import { useFormControlDisabled } from '@/composables/useFormControlDisabled';
import { useFormControlFullWidth } from '@/composables/useFormControlFullWidth';
import { useFormControlId } from '@/composables/useFormControlId';
import { useTemplateRef } from 'vue';

const emit = defineEmits<{
  (e: 'click', ev: MouseEvent): void;
  (e: 'focus', ev: FocusEvent): void;
  (e: 'blur', ev: FocusEvent): void;
  (e: 'keydown', ev: KeyboardEvent): void;
}>();

const props = withDefaults(defineProps<{
  value?: string;
  disabled?: boolean;
  fullWidth?: boolean;
  hideSelection?: boolean;
  positionAnchorName?: string;
  type?: 'text' | 'number' | 'date' | 'time' | 'datetime-local' | 'color';
  min?: string | number;
  max?: string | number;
  tabindex?: string | number;
  'class'?: string;
}>(), {
  value: undefined,
  fullWidth: undefined,
  hideSelection: undefined,
  positionAnchorName: undefined,
  type: undefined,
  min: undefined,
  max: undefined,
  tabindex: undefined,
  class: undefined,
});

const inputRef = useTemplateRef<HTMLInputElement>('input-el');

const id = useFormControlId();
const effectiveDisabled = useFormControlDisabled(props);
const effectiveFullWidth = useFormControlFullWidth(props);

export interface InputApi {
  focus: () => void;
  select: () => void;
  inputEl: HTMLInputElement | null;
}

defineExpose({
  focus: () => inputRef?.value?.focus(),
  select: () => inputRef?.value?.select(),
  inputEl: inputRef,
});
</script>

<template>
  <input
    :id="id"
    ref="input-el"
    :value="value"
    :type="type"
    :class="['input-field', props.class, { 'hide-selection': hideSelection, 'full-width': effectiveFullWidth }]"
    :readonly="true"
    :disabled="effectiveDisabled"
    :min="min"
    :max="max"
    :tabindex="tabindex"
    :style="positionAnchorName ? `anchor-name: ${positionAnchorName}` : undefined"
    @click="emit('click', $event)"
    @focus="emit('focus', $event)"
    @blur="emit('blur', $event)"
    @keydown="emit('keydown', $event)"
  >
</template>
