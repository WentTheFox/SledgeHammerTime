<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, useTemplateRef, watch } from 'vue';

const props = withDefaults(defineProps<{
  visible: boolean,
  'class'?: string,
  maxHeight?: number;
  animate?: boolean;
}>(), {
  'class': undefined,
  maxHeight: undefined,
  animate: true,
});

const isSsr = typeof window === 'undefined';
const collapsibleRef = useTemplateRef('collapsibleRef');
const height = ref(props.maxHeight);
const isTransitioning = ref(false);

const effectiveHeight = computed(() => props.maxHeight && height.value ? Math.min(props.maxHeight, height.value) : height.value);

const handleResize = () => {
  if (isTransitioning.value) return;

  if (collapsibleRef.value) {
    const contentHeight = Array.from(collapsibleRef.value.children).reduce((totalContentHeight, childNode) => {
      return totalContentHeight + childNode.getBoundingClientRect().height;
    }, 0);
    height.value = Math.min(props.maxHeight ?? Infinity, contentHeight);
  }
};
const resizeObserver = !isSsr ? new ResizeObserver(handleResize) : undefined;

const handleTransitionStart = () => {
  isTransitioning.value = true;
};

const handleTransitionEnd = () => {
  isTransitioning.value = false;
};

watch(() => props.visible, (newVisible) => {
  if (newVisible) {
    if (collapsibleRef.value) {
      // Reset scroll position on opening
      collapsibleRef.value.scrollTop = 0;
    }
  }
});

onMounted(() => {
  handleResize();
  if (resizeObserver && collapsibleRef.value) {
    resizeObserver.observe(collapsibleRef.value);
    collapsibleRef.value.addEventListener('transitionstart', handleTransitionStart);
    collapsibleRef.value.addEventListener('transitionend', handleTransitionEnd);
  }
});

onUnmounted(() => {
  if (resizeObserver && collapsibleRef.value) {
    resizeObserver.unobserve(collapsibleRef.value);
    collapsibleRef.value.removeEventListener('transitionstart', handleTransitionStart);
    collapsibleRef.value.removeEventListener('transitionend', handleTransitionEnd);
  }
});

watch(() => props.maxHeight, () => {
  handleResize();
});

export interface CollapsibleAPI {
  recalculateHeight: VoidFunction;
}

const api: CollapsibleAPI = {
  recalculateHeight() {
    handleResize();
  },
};

defineExpose(api);
</script>

<template>
  <div
    ref="collapsibleRef"
    :class="['collapsible', { visible: visible, 'limited-height': !!maxHeight, animate }, props.class]"
    :style="`height: ${effectiveHeight}px`"
    :inert="!visible"
  >
    <div class="collapsible-inner">
      <slot />
    </div>
  </div>
</template>
