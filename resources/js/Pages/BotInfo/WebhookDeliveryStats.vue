<script setup lang="ts">
import { useNumberFormatter } from '@/composables/useNumberFormatter';
import { currentLanguageInject, localSettingsInject, themeInject } from '@/injection-keys';
import HtCard from '@/Reusable/HtCard.vue';
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import {
  CategoryScale,
  Chart as ChartJS,
  type ChartOptions,
  type ScriptableContext,
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
  // null for a 5-minute bucket with no requests - kept as an explicit gap in the grid
  // (rather than omitted) so the x-axis stays evenly spaced in real time; see
  // BotInfoController::collectWebhookDeliveryStats.
  avgDurationMs: number | null;
  medianDurationMs: number | null;
  p95DurationMs: number | null;
}

// Chart.js dataset objects accept arbitrary extra properties, but its types don't know
// about ours - used to stash each capped series' real (uncapped) values for the tooltip.
interface RawDataDataset {
  rawData?: (number | null)[];
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
const medianColor = computed(() => theme?.isLightTheme ? '#2e8b57' : '#4fbf74');
const p95Color = computed(() => theme?.isLightTheme ? '#eb6834' : '#d95926');
const goodColor = computed(() => theme?.isLightTheme ? '#2e8b57' : '#4fbf74');
const badColor = computed(() => theme?.isLightTheme ? '#eb6834' : '#d95926');
// In Chinese (and Japanese) markets red is the "good/up" color and green is "bad/down" -
// the opposite of the western convention - so swap which one means success in those locales.
const flipGoodBadColors = computed(() => /^(zh|ja)(-|$)/i.test(String(currentLanguage?.value.locale ?? '')));
const successColor = computed(() => flipGoodBadColors.value ? badColor.value : goodColor.value);
const errorColor = computed(() => flipGoodBadColors.value ? goodColor.value : badColor.value);
const limitColor = computed(() => theme?.isLightTheme ? '#999' : '#888');

// Discord requires an initial interaction response within 3 seconds, or the
// interaction token is invalidated and the reply fails outright.
const discordResponseLimitMs = 3000;

// A single outlier request (e.g. a genuine multi-second timeout) otherwise stretches the
// whole y-axis so far that every normal data point flatlines near zero. Points over this
// get their line clamped to the cap and marked with a triangle instead of being allowed to
// blow the scale out - see buildCappedSeries().
const latencyCapMs = 3500;

const latencyMaxY = computed(() => Math.min(
  latencyCapMs,
  Math.max(
    discordResponseLimitMs,
    ...(props.stats ?? [])
      .flatMap((point) => [point.avgDurationMs, point.medianDurationMs, point.p95DurationMs])
      .filter((value) => value !== null),
  ),
));

/**
 * Clamps a series' values to latencyCapMs for plotting (so the line is drawn AT the cap,
 * not silently dropped off-canvas), while marking clamped points with a visible triangle
 * and keeping the real, uncapped values around for the tooltip to read back.
 */
function buildCappedSeries(rawValues: (number | null)[]) {
  const isOverCap = rawValues.map((value) => value !== null && value > latencyCapMs);

  return {
    // Empty buckets have no value (null); plot them at 0 so the line drops to the floor on
    // quiet stretches instead of breaking. rawData keeps the null for the tooltip.
    data: rawValues.map((value) => value === null ? 0 : Math.min(value, latencyCapMs)),
    rawData: rawValues,
    pointRadius: isOverCap.map((over) => over ? 5 : 0),
    pointHoverRadius: isOverCap.map((over) => over ? 7 : 0),
    pointStyle: isOverCap.map((over) => over ? 'triangle' : 'circle'),
  };
}

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
      tension: 0.2,
      ...buildCappedSeries((props.stats ?? []).map((point) => point.avgDurationMs)),
    },
    {
      // Robust to outliers where average isn't - a single huge spike drags the average
      // toward it but barely moves the median, so this is a better "typical" indicator.
      label: wTrans('botInfo.webhookDeliveryStats.latencyMedianLabel').value,
      borderColor: medianColor.value,
      backgroundColor: medianColor.value,
      borderWidth: 2,
      tension: 0.2,
      ...buildCappedSeries((props.stats ?? []).map((point) => point.medianDurationMs)),
    },
    {
      label: wTrans('botInfo.webhookDeliveryStats.latencyP95Label').value,
      borderColor: p95Color.value,
      backgroundColor: p95Color.value,
      borderWidth: 2,
      tension: 0.2,
      ...buildCappedSeries((props.stats ?? []).map((point) => point.p95DurationMs)),
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

// Vertical gradient pinned to the y-axis values (not the line's own extent), so the same
// success rate is always the same color: full success color from 100% down to
// gradientGoodUntilPercent, blending to the error color by gradientBadFromPercent. Real
// success rates sit in a narrow band near the top, so spreading this over the whole 0-100 axis
// would leave the line green even at a 50% success rate.
const gradientGoodUntilPercent = 98;
const gradientBadFromPercent = 80;

function successLineColor(context: ScriptableContext<'line'>): string | CanvasGradient {
  const { chart } = context;
  const { ctx, chartArea, scales } = chart;
  // Not laid out yet (first render pass, legend swatch) - nothing to build a gradient against.
  if (!chartArea || !scales.y) return successColor.value;

  const top = scales.y.getPixelForValue(100);
  const bottom = scales.y.getPixelForValue(0);
  const offsetFor = (percent: number) => Math.min(1, Math.max(0, (100 - percent) / 100));

  const gradient = ctx.createLinearGradient(0, top, 0, bottom);
  gradient.addColorStop(0, successColor.value);
  gradient.addColorStop(offsetFor(gradientGoodUntilPercent), successColor.value);
  gradient.addColorStop(offsetFor(gradientBadFromPercent), errorColor.value);
  gradient.addColorStop(1, errorColor.value);
  return gradient;
}

const healthChartData = computed(() => ({
  labels: labels.value,
  datasets: [
    {
      label: wTrans('botInfo.webhookDeliveryStats.successRateLabel').value,
      borderColor: successLineColor,
      backgroundColor: successColor.value,
      borderWidth: 2,
      pointRadius: 0,
      pointHoverRadius: 0,
      tension: 0.2,
      // Buckets with no requests have no success rate (100% of nothing is meaningless), so
      // they're left null and bridged instead of plotted as a perfect score or a total failure.
      spanGaps: true,
      data: (props.stats ?? []).map((point) => point.requestCount > 0
        ? Math.round((1 - point.errorRate) * 1000) / 10
        : null),
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
      // Empty 5-minute buckets carry a null avg/median/p95 (see WebhookDeliveryStatsPoint) and
      // are plotted at 0 - hide them from the tooltip rather than showing a misleading "0 ms".
      filter: (item) => {
        const rawData = (item.dataset as RawDataDataset).rawData;
        return !rawData || rawData[item.dataIndex] !== null;
      },
      callbacks: {
        label: (item) => {
          // Points over latencyCapMs are plotted clamped (see buildCappedSeries) so the
          // line doesn't fly off the chart - show the real value here, not the clamped one.
          const rawValue = (item.dataset as RawDataDataset).rawData?.[item.dataIndex];
          return `${item.dataset.label}: ${numberFormatter.value.format(rawValue ?? item.parsed.y ?? 0)} ms`;
        },
      },
    },
  },
}));

const healthChartOptions = computed<ChartOptions<'line'>>(() => ({
  ...baseChartOptions.value,
  interaction: {
    mode: 'index',
    intersect: false,
  },
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
      mode: 'index',
      intersect: false,
      filter: (item) => item.parsed.y !== null,
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
        <h3>{{ $t('botInfo.webhookDeliveryStats.healthChartTitle') }}</h3>
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
            :data="healthChartData"
            :options="healthChartOptions"
          />
        </div>
      </div>
    </div>
  </HtCard>
</template>
