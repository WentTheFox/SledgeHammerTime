<script setup lang="ts">
import { formControlIdInject, isJsUnavailableInject } from '@/injection-keys';
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';
import { computed, inject, provide } from 'vue';

const props = defineProps<{
  id: string,
  label: string,
  name?: string,
  disabled?: boolean;
}>();

const model = defineModel<boolean>({ required: true });

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
    <template #input>
      <input
        :id="formControlId"
        v-model="model"
        type="checkbox"
        :name="name"
        :disabled="inputDisabled"
        class="form-checkbox-input"
        :aria-describedby="`${formControlId}-description`"
      >
    </template>
    <template #message>
      <slot name="message" />
    </template>
  </HtFormCheckbox>
</template>
