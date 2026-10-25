<script setup lang="ts">

import { useRoute } from '@/composables/useRoute';
import { currentLanguageInject } from '@/injection-keys';
import HtOptimizedImage from '@/Reusable/HtOptimizedImage.vue';
// noinspection ES6UnusedImports
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

const props = defineProps<{
  href: string;
  image: string;
  // Shown instead of `image` when the dark theme is active
  darkImage?: string;
  name?: string;
  desc?: string;
  isLocal?: boolean;
  allowReferrer?: boolean;
  smallSize?: boolean;
}>();

const route = useRoute();
const currentLanguage = inject(currentLanguageInject);
const displayName = computed(() => {
  if (props.name) {
    return props.name;
  }

  const url = new URL(props.href);
  return (url.hostname + url.pathname)
    // Remove trailing slashes
    .replace(/\/+$/, '')
    // Add word-break opportunities
    .replace(/([./-]|discord|time|stamp)/g, '$1\u200b');
});
</script>

<template>
  <div :class="['useful-link', { 'small-size': smallSize }]">
    <component
      :is="isLocal ? Link : 'a'"
      :href="isLocal ? route(href, { locale: currentLanguage?.locale ?? FALLBACK_LANGUAGE }) : href"
      :target="isLocal ? undefined : '_blank'"
      :rel="isLocal ? undefined : `noopener${allowReferrer ? '' : ' noreferrer'}`"
      class="link-wrap"
    >
      <div class="link-card">
        <div class="card-top-half">
          <HtOptimizedImage
            :src="image"
            :class="darkImage ? 'theme-light-image' : undefined"
            alt=""
          />
          <HtOptimizedImage
            v-if="darkImage"
            :src="darkImage"
            class="theme-dark-image"
            alt=""
          />
        </div>

        <div class="card-bottom-half">
          <span class="link-name">
            <slot name="name">{{ displayName }}</slot>
          </span>

          <span
            v-if="desc"
            class="link-desc"
          >
            <slot name="desc">{{ desc }}</slot>
          </span>
        </div>
      </div>
    </component>
  </div>
</template>
