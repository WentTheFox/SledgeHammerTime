<script setup lang="ts">
import { useLayout } from '@/composables/useLayout';
import { defaultLayoutProps, LayoutProps } from '@/injection-keys';
import DesignElements from '@/Pages/Design/DesignElements.vue';
import HtContent from '@/Reusable/HtContent.vue';
import HtHeader from '@/Reusable/HtHeader.vue';
import { Head } from '@inertiajs/vue3';

const props = withDefaults(defineProps<Partial<LayoutProps>>(), defaultLayoutProps);

useLayout(props);
</script>

<template>
  <Head :title="$t('design.title')" />

  <HtHeader>
    <template #left>
      Left
    </template>
    <template #brand>
      Brand
    </template>
    <template #right>
      Right
    </template>
  </HtHeader>

  <HtContent>
    <DesignElements />
  </HtContent>
</template>
