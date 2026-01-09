<script setup lang="ts">
import { useFormControlId } from '@/composables/useFormControlId';
import { faChevronDown } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { useTemplateRef } from 'vue';

const formControlId = useFormControlId();
const model = defineModel<unknown>();

const props = defineProps<{
  name?: string,
  class?: string,
  disabled?: boolean,
  readonly?: boolean,
}>();

const emit = defineEmits<{
  (e: 'keydown', ev: KeyboardEvent): void;
  (e: 'change', ev: Event): void;
  (e: 'focus', ev: FocusEvent): void;
}>();

const selectRef = useTemplateRef<HTMLSelectElement>('select-el');

const focus = () => {
  selectRef.value?.focus();
};

export interface FormSelectApi {
  focus: typeof focus;
}

defineExpose<FormSelectApi>({
  focus,
});
</script>

<template>
  <div :class="['form-control-select', { disabled }]">
    <select
      :id="formControlId"
      ref="select-el"
      v-model="model"
      :name="name"
      :class="['form-select-input input-field hide-selection', props.class]"
      :disabled="disabled || readonly"
      @keydown="emit('keydown', $event)"
      @change="emit('change', $event)"
      @focus.passive="emit('focus', $event)"
    >
      <slot />
    </select>
    <span class="form-select-icon">
      <FontAwesomeIcon
        :icon="faChevronDown"
        :fixed-width="true"
      />
    </span>
  </div>
</template>
