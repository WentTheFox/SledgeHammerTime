<script setup lang="ts">
import Navbar from '@/Components/CustomNavbar.vue';
import { useLayout } from '@/composables/useLayout';
import { defaultLayoutProps, LayoutProps } from '@/injection-keys';
import { PageProps } from '@/types';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtContent from '@/Reusable/HtContent.vue';
// eslint-disable-next-line @typescript-eslint/no-unused-vars -- ESLint is drunk
import { faExclamationTriangle } from '@fortawesome/free-solid-svg-icons';
// eslint-disable-next-line @typescript-eslint/no-unused-vars -- ESLint is drunk
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { usePage } from '@inertiajs/vue3';
import { computed, useSlots } from 'vue';

const props = withDefaults(defineProps<Partial<LayoutProps>>(), defaultLayoutProps);

useLayout(props);
const slots = useSlots();

// Not injected: useLayout() provides the page props from this very component, and inject() only sees ancestors
const page = usePage<PageProps>();
const readOnly = computed(() => page.props.app?.readOnly === true);
</script>

<template>
  <Navbar />

  <HtContent>
    <template
      v-if="slots.sidebarWidgets"
      #sidebarWidgets
    >
      <slot name="sidebarWidgets" />
    </template>
    <noscript>
      <div class="alert warning mb-3">
      <div class="alert-content">
      <div class="alert-title">
      <FontAwesomeIcon
      :icon="faExclamationTriangle"
      :fixed-width="true"
      size="1x"
      class="me-2"
      />
      {{ $t('global.jsDisabled.title') }}
      </div>
      <div class="alert-text">
      {{ $t('global.jsDisabled.body') }}
      </div>
      </div>
      </div>
    </noscript>

    <HtAlert
      v-if="readOnly"
      type="info"
      compact-inline
      :closable="false"
      class="mb-3"
    >
      <template #title>
        {{ $t('global.readOnly.title') }}
      </template>
      <template #text>
        {{ $t('global.readOnly.body') }}
      </template>
    </HtAlert>

    <slot />
  </HtContent>
</template>
