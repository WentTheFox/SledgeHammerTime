<script setup lang="ts">
import { useFormControlId } from '@/composables/useFormControlId';
import { isJsUnavailableInject } from '@/injection-keys';
import { inject, useTemplateRef } from 'vue';

const emit = defineEmits<{
  (e: 'click', ev: MouseEvent): void;
  (e: 'focus', ev: FocusEvent): void;
  (e: 'blur', ev: FocusEvent): void;
  (e: 'keydown', ev: KeyboardEvent): void;
  (e: 'change', ev: Event): void;
}>();

const props = defineProps<{
  id?: string;
  readonly?: boolean;
  disabled?: boolean;
  hideSelection?: boolean;
  positionAnchorName?: string;
  type?: 'text' | 'number' | 'date' | 'time' | 'datetime-local' | 'color' | 'checkbox';
  min?: string | number;
  max?: string | number;
  step?: string | number;
  tabindex?: string | number;
  inputmode?: 'decimal' | 'email' | 'none' | 'numeric' | 'search' | 'tel' | 'text' | 'url';
  'class'?: string;
}>();

const model = defineModel<string | number | null>();

const inputRef = useTemplateRef<HTMLInputElement>('input-el');

const formControlId = useFormControlId(props);

const isJsUnavailable = inject(isJsUnavailableInject);

export interface InputApi {
  focus: () => void;
  select: () => void;
  setCustomValidity: (validity: string) => void;
  reportValidity: () => void;
  inputEl: HTMLInputElement | null;
}

defineExpose({
  focus: () => inputRef?.value?.focus(),
  select: () => inputRef?.value?.select(),
  setCustomValidity: (validity: string) => inputRef?.value?.setCustomValidity(validity),
  reportValidity: () => inputRef?.value?.reportValidity(),
  inputEl: inputRef,
});
</script>

<template>
  <input
    :id="formControlId"
    ref="input-el"
    v-model="model"
    :type="type"
    :class="['input-field', props.class, { 'hide-selection': hideSelection }]"
    :readonly="readonly"
    :disabled="isJsUnavailable || disabled"
    :min="min"
    :max="max"
    :tabindex="tabindex"
    :inputmode="inputmode"
    :style="positionAnchorName ? `anchor-name: ${positionAnchorName}` : undefined"
    :step="step"
    :aria-describedby="`${formControlId}-description`"
    :data-testid="`${formControlId}-input`"
    @click="emit('click', $event)"
    @focus="emit('focus', $event)"
    @blur="emit('blur', $event)"
    @keydown="emit('keydown', $event)"
    @change="emit('change', $event)"
  >
</template>
