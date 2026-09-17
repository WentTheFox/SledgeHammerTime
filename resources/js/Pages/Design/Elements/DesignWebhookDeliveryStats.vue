<script setup lang="ts">
import WebhookDeliveryStats, { WebhookDeliveryStatsPoint } from '@/Pages/BotInfo/WebhookDeliveryStats.vue';
import HtButton from '@/Reusable/HtButton.vue';
import { faRefresh } from '@fortawesome/free-solid-svg-icons';
import { ref } from 'vue';

const windowHours = 48;

const generatePoints = (): WebhookDeliveryStatsPoint[] => {
  const now = Date.now();
  return Array.from({ length: windowHours }, (_, i) => {
    const requestCount = Math.round(20 + Math.random() * 80);
    return {
      bucket: new Date(now - (windowHours - 1 - i) * 60 * 60 * 1000).toISOString(),
      requestCount,
      errorRate: Math.random() * 0.05,
      avgDurationMs: Math.round(120 + Math.random() * 80),
      p95DurationMs: Math.round(250 + Math.random() * 200),
    };
  });
};

const stats = ref<WebhookDeliveryStatsPoint[] | null>(generatePoints());

const regenerate = () => {
  stats.value = generatePoints();
};
const setLoading = () => {
  stats.value = null;
};
const setNoData = () => {
  stats.value = [];
};
</script>

<template>
  <p class="mt-3 mb-3">
    Webhook delivery stats
  </p>
  <WebhookDeliveryStats
    :stats="stats"
    :window-hours="windowHours"
  />
  <div class="mt-2">
    <HtButton
      color="primary"
      :icon-start="faRefresh"
      @click="regenerate"
    >
      Regenerate
    </HtButton>
    &nbsp;
    <HtButton
      @click="setLoading"
    >
      Loading state
    </HtButton>
    &nbsp;
    <HtButton
      color="danger"
      @click="setNoData"
    >
      No data
    </HtButton>
  </div>
</template>
