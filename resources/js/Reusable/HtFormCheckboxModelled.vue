<script setup lang="ts">
import { useIsJsUnavailable } from '@/composables/useIsJsUnavailable';
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';
import HtFormControlSettings from '@/Reusable/HtFormControlSettings.vue';
import { computed } from 'vue';

const props = defineProps<{
  id: string,
  label: string,
  name?: string,
  disabled?: boolean;
}>();

const model = defineModel<boolean>({ required: true });

const isJsUnavailable = useIsJsUnavailable();

const inputDisabled = computed(() => (isJsUnavailable?.value ?? true) || props.disabled);
</script>

<template>
  <HtFormControlSettings
    :id="id"
    :disabled="disabled"
  >
    <HtFormCheckbox
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
          :aria-describedby="`${id}-description`"
        >
      </template>
      <template #message>
        <slot name="message" />
      </template>
    </HtFormCheckbox>
  </HtFormControlSettings>
</template>
