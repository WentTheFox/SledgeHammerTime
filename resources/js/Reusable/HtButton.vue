<script setup lang="ts">

import HtButtonContent, { HtButtonContentProps } from '@/Reusable/HtButtonContent.vue';
import { ButtonColors, getButtonClasses } from '@/utils/buttons';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  type?: 'button' | 'submit',
  /**
   * Defaults to gray when not provided
   */
  color?: ButtonColors,
  'class'?: string | Record<string, boolean> | Array<string | undefined | Record<string, boolean>>,
  disabled?: boolean,
  tabindex?: string | number,
  block?: boolean,
  pressed?: boolean,
  justifyCenter?: boolean,
  title?: string,
} & Partial<HtButtonContentProps>>(), {
  type: 'button',
  color: undefined,
  'class': undefined,
  disabled: false,
  loading: false,
  block: false,
  tabindex: undefined,
  pressed: false,
  iconOnly: false,
  iconStart: undefined,
  iconEnd: undefined,
  justifyCenter: false,
  title: undefined,
});

const buttonClasses = computed(() => getButtonClasses(props));

const emit = defineEmits<{
  (e: 'click', event: MouseEvent): void;
}>();
</script>

<template>
  <button
    :type="type"
    :class="buttonClasses"
    :disabled="props.disabled || props.loading"
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
