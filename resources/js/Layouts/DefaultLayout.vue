<script setup lang="ts">
import Navbar from '@/Components/CustomNavbar.vue';
import { useLayout } from '@/composables/useLayout';
import { defaultLayoutProps, LayoutProps } from '@/injection-keys';
import { pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtContent from '@/Reusable/HtContent.vue';
// eslint-disable-next-line @typescript-eslint/no-unused-vars -- ESLint is drunk
import { faExclamationTriangle } from '@fortawesome/free-solid-svg-icons';
// eslint-disable-next-line @typescript-eslint/no-unused-vars -- ESLint is drunk
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject, useSlots } from 'vue';

const props = withDefaults(defineProps<Partial<LayoutProps>>(), defaultLayoutProps);

useLayout(props);
const slots = useSlots();
const pageProps = inject(pagePropsInject);
const readOnly = computed(() => pageProps?.value.app?.readOnly === true);
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
      type="warning"
      :closable="false"
      class="mb-3"
    >
      <template #title>
        Read-only mode
      </template>
      <template #text>
        The site is temporarily in read-only mode. Everything can still be viewed, but changes (such as saving settings or logging in) will not work for now.
      </template>
    </HtAlert>

    <slot />
  </HtContent>
</template>
