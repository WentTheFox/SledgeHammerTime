<script setup lang="ts">
import { useIsJsUnavailable } from '@/composables/useIsJsUnavailable';
import HtFormCheckbox from '@/Reusable/HtFormCheckbox.vue';
import HtFormControlSettings from '@/Reusable/HtFormControlSettings.vue';
import { computed, useSlots } from 'vue';

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

const isJsUnavailable = useIsJsUnavailable();

const inputDisabled = computed(() => isJsUnavailable?.value || props.disabled);
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
      <template
        v-if="slots.label"
        #label
      >
        <slot name="label" />
      </template>
      <template #input>
        <input
          :id="id"
          type="checkbox"
          :checked="checked"
          :name="name"
          :value="value"
          :disabled="inputDisabled"
          class="form-checkbox-input"
          :aria-describedby="`${id}-description`"
          @change="emit('change', $event)"
        >
      </template>
      <template #message>
        <slot name="message" />
      </template>
    </HtFormCheckbox>
  </HtFormControlSettings>
</template>
