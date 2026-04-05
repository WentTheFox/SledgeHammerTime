<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import LegalInfoSections from '@/Pages/Legal/LegalInfoSections.vue';
import TranslationsAlert from '@/Pages/Legal/TranslationsAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const fallbackLocale = computed(() => page.props.app?.fallbackLocale ?? 'en');
</script>

<template>
  <Head :title="$t('global.nav.legal')" />

  <Layout>
    <HtCard>
      <template #header>
        <h1>{{ $t('global.nav.legal') }}</h1>
      </template>
    </HtCard>

    <TranslationsAlert :fallback-locale="fallbackLocale" />

    <LegalInfoSections />
  </Layout>
</template>

