<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import AnalyticsCards, { AnalyticsCardsProps } from '@/Pages/Analytics/AnalyticsCards.vue';
import { Head } from '@inertiajs/vue3';

defineProps<AnalyticsCardsProps>();
</script>

<template>
  <Head :title="$t('analytics.heading')" />

  <Layout>
    <AnalyticsCards
      :last-updated="lastUpdated"
      :daily-totals="dailyTotals"
      :locale-breakdown="localeBreakdown"
      :route-breakdown="routeBreakdown"
    />
  </Layout>
</template>
