<script setup lang="ts">
import { isJsUnavailableInject } from '@/injection-keys';
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';
import { computed, inject } from 'vue';

const props = defineProps<{
  id: string,
  label: string,
  name?: string,
  disabled?: boolean;
}>();

const model = defineModel<boolean>({ required: true });

const isJsUnavailable = inject(isJsUnavailableInject);

const inputDisabled = computed(() => isJsUnavailable?.value || props.disabled);
</script>

<template>
  <HtFormCheckbox
    :id="id"
    :label="label"
    :disabled="disabled"
  >
    <template #input>
      <input
        :id="id"
        v-model="model"
        type="checkbox"
        :name="name"
        :disabled="inputDisabled"
        class="form-checkbox-input"
      >
    </template>
    <template #message>
      <slot name="message" />
    </template>
  </HtFormCheckbox>
</template>
