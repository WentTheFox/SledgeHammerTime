<script setup lang="ts">
import { formControlIdInject, isJsUnavailableInject } from '@/injection-keys';
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';
import { computed, inject, provide, useSlots } from 'vue';

const props = defineProps<{
  id: string,
  label?: string,
  name?: string,
  value?: string,
  checked: boolean;
  disabled?: boolean;
}>();

const emit = defineEmits<{
  (e: 'change', event: Event): void;
}>();

const slots = useSlots();

const isJsUnavailable = inject(isJsUnavailableInject);

const inputDisabled = computed(() => isJsUnavailable?.value || props.disabled);

const formControlId = computed(() => props.id);
provide(formControlIdInject, formControlId);
</script>

<template>
  <HtFormCheckbox
    :label="label"
    :disabled="disabled"
  >
    <template
      v-if="slots.label"
      #label
    >
      <slot name="label" />
    </template>
    <template #input>
      <input
        :id="formControlId"
        type="checkbox"
        :checked="checked"
        :name="name"
        :value="value"
        :disabled="inputDisabled"
        class="form-checkbox-input"
        :aria-describedby="`${formControlId}-description`"
        @change="emit('change', $event)"
      >
    </template>
    <template #message>
      <slot name="message" />
    </template>
  </HtFormCheckbox>
</template>
