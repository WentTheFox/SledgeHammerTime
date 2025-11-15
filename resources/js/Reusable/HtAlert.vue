<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { faInfo, faTimes, faWarning } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, ComputedRef, useSlots } from 'vue';

export type AlertType = 'info' | 'warning' | 'error' | string;

const props = withDefaults(defineProps<{
  type: AlertType;
  closable?: boolean;
  loading?: boolean;
  compact?: boolean;
}>(), {
  closable: true,
  loading: false,
  compact: false,
});

const slots = useSlots();

const icon: ComputedRef<IconDefinition | null> = computed(() => {
  switch (props.type) {
    case "info":
      return faInfo;
    case "warning":
      return faWarning;
  }
  return null;
});

const emit = defineEmits<{
  (on: 'close'): void;
}>();
</script>

<template>
  <div :class="['alert', type, { compact }]">
    <div
      v-if="icon || loading"
      class="alert-icon"
    >
      <HtLoadingIndicator
        v-if="loading"
        :size="16"
      />
      <FontAwesomeIcon
        v-else-if="icon"
        :icon="icon"
        :fixed-width="true"
      />
    </div>
    <div class="alert-content">
      <div
        v-if="slots.title"
        class="alert-title"
      >
        <slot name="title" />
      </div>
      <div
        v-if="slots.text"
        class="alert-text"
      >
        <slot name="text" />
      </div>
      <div
        v-if="slots.actions"
        class="alert-actions"
      >
        <slot name="actions" />
      </div>
    </div>
    <div class="alert-close">
      <HtButton
        v-if="closable"
        class="close-button"
        @click.prevent="emit('close')"
      >
        <FontAwesomeIcon :icon="faTimes" />
      </HtButton>
    </div>
  </div>
</template>
