<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import AnalyticsCards, { AnalyticsCardsProps } from '@/Pages/Analytics/AnalyticsCards.vue';
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref } from 'vue';

// The page HTML is cached, so the data comes from its own request instead of Inertia props
const data = ref<AnalyticsCardsProps | null>(null);
const failed = ref(false);

onMounted(async () => {
  try {
    data.value = (await axios.get<AnalyticsCardsProps>('/frontend/analytics')).data;
  } catch {
    failed.value = true;
  }
});
</script>

<template>
  <Head :title="$t('analytics.heading')" />

  <Layout>
    <AnalyticsCards
      v-if="data"
      :last-updated="data.lastUpdated"
      :window-days="data.windowDays"
      :daily-totals="data.dailyTotals"
      :locale-breakdown="data.localeBreakdown"
      :route-breakdown="data.routeBreakdown"
    />
    <HtLoadingIndicator v-else-if="!failed" />
  </Layout>
</template>
