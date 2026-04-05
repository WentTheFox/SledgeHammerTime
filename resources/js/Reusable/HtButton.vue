<script setup lang="ts">

import { useIsJsUnavailable } from '@/composables/useIsJsUnavailable';
import HtButtonContent, { HtButtonContentProps } from '@/Reusable/HtButtonContent.vue';
import { ButtonColors, ButtonSizes, getButtonClasses } from '@/utils/buttons';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  type?: 'button' | 'submit';
  /**
   * Defaults to gray when not provided
   */
  color?: ButtonColors;
  'class'?: string | Record<string, boolean> | Array<string | undefined | Record<string, boolean>>;
  disabled?: boolean;
  tabindex?: string | number;
  fullWidth?: boolean;
  pressed?: boolean;
  justifyCenter?: boolean;
  title?: string;
  size?: ButtonSizes;
} & Partial<HtButtonContentProps>>(), {
  type: 'button',
  color: undefined,
  'class': undefined,
  disabled: undefined,
  loading: false,
  fullWidth: undefined,
  tabindex: undefined,
  pressed: false,
  iconOnly: false,
  iconStart: undefined,
  iconEnd: undefined,
  justifyCenter: false,
  title: undefined,
  size: undefined,
});

const buttonClasses = computed(() => getButtonClasses(props));
const isJsUnavailable = useIsJsUnavailable();

const emit = defineEmits<{
  (e: 'click', event: MouseEvent): void;
}>();
</script>

<template>
  <button
    :type="type"
    :class="buttonClasses"
    :disabled="isJsUnavailable || props.disabled || props.loading"
    :tabindex="tabindex"
    :title="title"
    @click="emit('click', $event)"
  >
    <HtButtonContent
      :loading="loading"
      :icon-only="iconOnly"
      :icon-start="iconStart"
      :icon-end="iconEnd"
    >
      <slot />
    </HtButtonContent>
  </button>
</template>
