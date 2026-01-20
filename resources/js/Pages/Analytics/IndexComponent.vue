<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { Head } from '@inertiajs/vue3';
import AnalyticsCards, { AnalyticsCardsProps } from '@/Pages/Analytics/AnalyticsCards.vue';

defineProps<AnalyticsCardsProps>();
</script>

<template>
  <Head :title="$t('analytics.heading')" />

  <Layout>
    <HtCard>
      <template #header>
        <h1>{{ $t('analytics.heading') }}</h1>
      </template>
      <p class="mb-2">
        {{ $t('analytics.description') }}
      </p>
      <p> {{ $t('analytics.collectionMethod') }} </p>
    </HtCard>

    <AnalyticsCards
      :daily-totals="dailyTotals"
      :locale-breakdown="localeBreakdown"
      :route-breakdown="routeBreakdown"
    />
  </Layout>
</template>
