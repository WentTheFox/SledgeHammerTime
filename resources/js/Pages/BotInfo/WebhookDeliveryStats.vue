<script setup lang="ts">
import { useNumberFormatter } from '@/composables/useNumberFormatter';
import { currentLanguageInject, localSettingsInject, themeInject } from '@/injection-keys';
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
const currentLanguage = inject(currentLanguageInject);
const localSettings = inject(localSettingsInject);
const numberFormatter = useNumberFormatter();

const labelFormatter = computed(() => new Intl.DateTimeFormat(currentLanguage?.value.locale, {
  day: 'numeric',
  month: 'short',
  hour: '2-digit',
  minute: '2-digit',
  // Only pin h12/h24 when the user picked one explicitly - otherwise let the locale's own
  // convention decide, same as the rest of the app's date/time formatting.
  ...(localSettings?.hourCycle ? { hourCycle: localSettings.hourCycle } : {}),
}));
const labels = computed(() => (props.stats ?? []).map((point) => labelFormatter.value.format(new Date(point.bucket))));

// Validated against the light (#fcfcfb) and dark (#1a1a19) chart surfaces with
// scripts/validate_palette.js from the dataviz skill - keep both hexes together if either changes.
const avgColor = computed(() => theme?.isLightTheme ? '#2a78d6' : '#3987e5');
const p95Color = computed(() => theme?.isLightTheme ? '#eb6834' : '#d95926');
const errorColor = computed(() => theme?.isLightTheme ? '#eb6834' : '#d95926');
const limitColor = computed(() => theme?.isLightTheme ? '#999' : '#888');
const meanColor = computed(() => theme?.isLightTheme ? '#2e8b57' : '#4fbf74');

// Discord requires an initial interaction response within 3 seconds, or the
// interaction token is invalidated and the reply fails outright.
const discordResponseLimitMs = 3000;
const latencyMaxY = computed(() => Math.max(
  discordResponseLimitMs,
  ...(props.stats ?? []).flatMap((point) => [point.avgDurationMs, point.p95DurationMs]),
));

// Weighted by each bucket's own request count, not a plain average-of-averages, so
// buckets with more requests count proportionally more toward the overall mean.
const latencyMeanMs = computed(() => {
  const points = props.stats ?? [];
  const totalRequests = points.reduce((sum, point) => sum + point.requestCount, 0);
  if (totalRequests === 0) {
    return 0;
  }
  const weightedSum = points.reduce((sum, point) => sum + point.avgDurationMs * point.requestCount, 0);
  return weightedSum / totalRequests;
});

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
      pointRadius: 3,
      pointHoverRadius: 5,
      tension: 0.2,
      data: (props.stats ?? []).map((point) => point.avgDurationMs),
    },
    {
      label: wTrans('botInfo.webhookDeliveryStats.latencyP95Label').value,
      borderColor: p95Color.value,
      backgroundColor: p95Color.value,
      borderWidth: 2,
      pointRadius: 3,
      pointHoverRadius: 5,
      tension: 0.2,
      data: (props.stats ?? []).map((point) => point.p95DurationMs),
    },
    {
      label: wTrans('botInfo.webhookDeliveryStats.latencyMeanLabel').value,
      borderColor: meanColor.value,
      backgroundColor: meanColor.value,
      borderWidth: 1,
      borderDash: [2, 2],
      pointRadius: 0,
      pointHoverRadius: 0,
      pointHitRadius: 0,
      tension: 0,
      data: labels.value.map(() => latencyMeanMs.value),
    },
    {
      label: wTrans('botInfo.webhookDeliveryStats.latencyLimitLabel').value,
      borderColor: limitColor.value,
      backgroundColor: limitColor.value,
      borderWidth: 1,
      borderDash: [6, 4],
      pointRadius: 0,
      pointHoverRadius: 0,
      pointHitRadius: 0,
      tension: 0,
      data: labels.value.map(() => discordResponseLimitMs),
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
      pointRadius: 3,
      pointHoverRadius: 5,
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
  interaction: {
    mode: 'index',
    intersect: false,
  },
  scales: {
    ...baseChartOptions.value.scales,
    y: {
      ...baseChartOptions.value.scales?.y,
      max: latencyMaxY.value,
      ticks: {
        color: ticksColor.value,
        callback: (value) => `${numberFormatter.value.format(Number(value))} ms`,
      },
    },
  },
  plugins: {
    ...baseChartOptions.value.plugins,
    tooltip: {
      mode: 'index',
      intersect: false,
      callbacks: {
        label: (item) => `${item.dataset.label}: ${numberFormatter.value.format(item.parsed.y ?? 0)} ms`,
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
      min: 0,
      max: 100,
      ticks: {
        color: ticksColor.value,
        callback: (value) => `${numberFormatter.value.format(Number(value))}%`,
      },
    },
  },
  plugins: {
    ...baseChartOptions.value.plugins,
    tooltip: {
      callbacks: {
        label: (item) => `${item.dataset.label}: ${numberFormatter.value.format(item.parsed.y ?? 0)}%`,
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
