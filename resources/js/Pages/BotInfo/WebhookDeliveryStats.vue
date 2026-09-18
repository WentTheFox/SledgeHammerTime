<script setup lang="ts">
import { themeInject } from '@/injection-keys';
import HtCard from '@/Reusable/HtCard.vue';
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import {
  CategoryScale,
  Chart as ChartJS,
  type ChartOptions,
  Legend,
  LinearScale,
  LineElement,
  PointElement,
  Title,
  Tooltip,
} from 'chart.js';
import { wTrans } from 'laravel-vue-i18n';
import { computed, inject } from 'vue';
import { Line } from 'vue-chartjs';

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
);

export interface WebhookDeliveryStatsPoint {
  bucket: string;
  requestCount: number;
  errorRate: number;
  avgDurationMs: number;
  p95DurationMs: number;
}

const props = defineProps<{
  stats: WebhookDeliveryStatsPoint[] | null;
  windowHours: number;
}>();

const theme = inject(themeInject);

const labelFormatter = new Intl.DateTimeFormat(undefined, { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });
const labels = computed(() => (props.stats ?? []).map((point) => labelFormatter.format(new Date(point.bucket))));

// Validated against the light (#fcfcfb) and dark (#1a1a19) chart surfaces with
// scripts/validate_palette.js from the dataviz skill - keep both hexes together if either changes.
const avgColor = computed(() => theme?.isLightTheme ? '#2a78d6' : '#3987e5');
const p95Color = computed(() => theme?.isLightTheme ? '#eb6834' : '#d95926');
const errorColor = computed(() => theme?.isLightTheme ? '#eb6834' : '#d95926');

const labelsColor = computed(() => theme?.isLightTheme ? '#333' : '#eee');
const ticksColor = computed(() => theme?.isLightTheme ? '#666' : '#ccc');
const gridColor = computed(() => theme?.isLightTheme ? 'rgba(0, 0, 0, 0.1)' : 'rgba(255, 255, 255, 0.1)');

const latencyChartData = computed(() => ({
  labels: labels.value,
  datasets: [
    {
      label: wTrans('botInfo.webhookDeliveryStats.latencyAvgLabel').value,
      borderColor: avgColor.value,
      backgroundColor: avgColor.value,
      borderWidth: 2,
      pointRadius: 0,
      tension: 0.2,
      data: (props.stats ?? []).map((point) => point.avgDurationMs),
    },
    {
      label: wTrans('botInfo.webhookDeliveryStats.latencyP95Label').value,
      borderColor: p95Color.value,
      backgroundColor: p95Color.value,
      borderWidth: 2,
      pointRadius: 0,
      tension: 0.2,
      data: (props.stats ?? []).map((point) => point.p95DurationMs),
    },
  ],
}));

const errorRateChartData = computed(() => ({
  labels: labels.value,
  datasets: [
    {
      label: wTrans('botInfo.webhookDeliveryStats.errorRateLabel').value,
      borderColor: errorColor.value,
      backgroundColor: errorColor.value,
      borderWidth: 2,
      pointRadius: 0,
      tension: 0.2,
      data: (props.stats ?? []).map((point) => Math.round(point.errorRate * 1000) / 10),
    },
  ],
}));

const baseChartOptions = computed<ChartOptions<'line'>>(() => ({
  responsive: true,
  maintainAspectRatio: false,
  resizeDelay: 50,
  scales: {
    y: {
      beginAtZero: true,
      ticks: { color: ticksColor.value },
      grid: { color: gridColor.value },
    },
    x: {
      ticks: { color: ticksColor.value, maxRotation: 0, autoSkipPadding: 16 },
      grid: { display: false },
    },
  },
  plugins: {
    legend: {
      display: true,
      labels: { color: labelsColor.value },
    },
  },
}));

const latencyChartOptions = computed<ChartOptions<'line'>>(() => ({
  ...baseChartOptions.value,
  plugins: {
    ...baseChartOptions.value.plugins,
    tooltip: {
      callbacks: {
        label: (item) => `${item.dataset.label}: ${item.formattedValue} ms`,
      },
    },
  },
}));

const errorRateChartOptions = computed<ChartOptions<'line'>>(() => ({
  ...baseChartOptions.value,
  scales: {
    ...baseChartOptions.value.scales,
    y: {
      ...baseChartOptions.value.scales?.y,
      ticks: {
        color: ticksColor.value,
        callback: (value) => `${value}%`,
      },
    },
  },
  plugins: {
    ...baseChartOptions.value.plugins,
    tooltip: {
      callbacks: {
        label: (item) => `${item.dataset.label}: ${item.formattedValue}%`,
      },
    },
  },
}));

const hasData = computed(() => (props.stats ?? []).length > 0);
</script>

<template>
  <HtCard class="webhook-delivery-stats">
    <template #header>
      <h2>{{ $t('botInfo.webhookDeliveryStats.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.webhookDeliveryStats.description', { hours: String(windowHours) }) }}
    </p>

    <div class="webhook-delivery-stats-charts">
      <div class="webhook-delivery-stats-chart-panel">
        <h3>{{ $t('botInfo.webhookDeliveryStats.latencyChartTitle') }}</h3>
        <div class="webhook-delivery-stats-chart-container">
          <div
            v-if="stats === null"
            class="webhook-delivery-stats-placeholder"
          >
            <HtLoadingIndicator />
          </div>
          <p
            v-else-if="!hasData"
            class="webhook-delivery-stats-placeholder webhook-delivery-stats-no-data"
          >
            {{ $t('botInfo.webhookDeliveryStats.noData') }}
          </p>
          <Line
            v-else
            :data="latencyChartData"
            :options="latencyChartOptions"
          />
        </div>
      </div>

      <div class="webhook-delivery-stats-chart-panel">
        <h3>{{ $t('botInfo.webhookDeliveryStats.errorRateChartTitle') }}</h3>
        <div class="webhook-delivery-stats-chart-container">
          <div
            v-if="stats === null"
            class="webhook-delivery-stats-placeholder"
          >
            <HtLoadingIndicator />
          </div>
          <p
            v-else-if="!hasData"
            class="webhook-delivery-stats-placeholder webhook-delivery-stats-no-data"
          >
            {{ $t('botInfo.webhookDeliveryStats.noData') }}
          </p>
          <Line
            v-else
            :data="errorRateChartData"
            :options="errorRateChartOptions"
          />
        </div>
      </div>
    </div>
  </HtCard>
</template>
