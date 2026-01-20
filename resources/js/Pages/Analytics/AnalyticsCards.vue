<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { dateTimeLibraryInject, devModeInject, themeInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtCard from '@/Reusable/HtCard.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import {
  ArcElement,
  BarElement,
  CategoryScale,
  Chart as ChartJS,
  type ChartOptions,
  Legend,
  LinearScale,
  Title,
  Tooltip,
} from 'chart.js';
import { wTrans } from 'laravel-vue-i18n';
import { computed, inject, ref } from 'vue';
import { Bar, Doughnut } from 'vue-chartjs';

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  ArcElement,
);

export interface AnalyticsCardsProps {
  lastUpdated: string;
  dailyTotals: Array<{ date: string; route: string; total: number }>;
  routeBreakdown: Array<{ route: string; total: number }>;
  localeBreakdown: Array<{ locale: string; total: number }>;
}

const props = defineProps<AnalyticsCardsProps>();
const unknownLabel = wTrans('analytics.values.unknown');

const skipNull = ref(true);

const theme = inject(themeInject);
const devMode = inject(devModeInject);
const dtl = inject(dateTimeLibraryInject);
const lastUpdateTime = computed(() => props.lastUpdated ? dtl?.value.fromIsoString(props.lastUpdated) : undefined);

const barChartData = computed(() => {
  const routes = [...new Set(props.dailyTotals.map(d => d.route))];
  const dates = [...new Set(props.dailyTotals.map(d => d.date))].sort();
  const palette = generatePalette(routes.length, theme?.isLightTheme ?? true);

  const datasets = routes.map((route, index) => {
    return {
      label: route === 'Unknown' ? unknownLabel.value : route,
      backgroundColor: palette[index],
      data: dates.map(date => {
        const record = props.dailyTotals.find(d => d.date === date && d.route === route);
        return record ? record.total : 0;
      }),
      borderWidth: 0,
    };
  });

  return {
    labels: dates,
    datasets,
  };
});

const generatePalette = (count: number, isLight: boolean) => {
  const colors = [];
  const saturation = isLight ? '60%' : '50%';
  const lightness = isLight ? '50%' : '30%';

  for (let i = 0; i < count; i++) {
    const hue = (i * (360 / Math.min(count, 10))) % 360;
    // Using a golden angle approach for better distribution if the count is high
    const hueGolden = (i * 137.508) % 360;
    const finalHue = count <= 10 ? hue : hueGolden;
    colors.push(`hsl(${finalHue}, ${saturation}, ${lightness})`);
  }
  return colors;
};

const filteredRouteBreakdown = computed(() => props.routeBreakdown.filter(r => r.route !== null || !skipNull.value));

const routeChartData = computed(() => ({
  labels: filteredRouteBreakdown.value.map((r) => r.route ?? unknownLabel.value),
  datasets: [
    {
      backgroundColor: generatePalette(props.routeBreakdown.length, theme?.isLightTheme ?? true),
      data: filteredRouteBreakdown.value.map((r) => r.total),
      borderWidth: 0,
    },
  ],
}));

const filteredLocaleBreakdown = computed(() => props.localeBreakdown.filter(l => l.locale !== null || !skipNull.value));

const localeChartData = computed(() => ({
  labels: filteredLocaleBreakdown.value.map((l) => l.locale ?? unknownLabel.value),
  datasets: [
    {
      backgroundColor: generatePalette(props.localeBreakdown.length, theme?.isLightTheme ?? true),
      data: filteredLocaleBreakdown.value.map((l) => l.total),
      borderWidth: 0,
    },
  ],
}));

const labelsColor = computed(() => theme?.isLightTheme ? '#333' : '#eee');
const ticksColor = computed(() => theme?.isLightTheme ? '#666' : '#ccc');
const gridColor = computed(() => theme?.isLightTheme ? 'rgba(0, 0, 0, 0.1)' : 'rgba(255, 255, 255, 0.1)');

const barChartOptions = computed<ChartOptions<'bar'>>(() => ({
  responsive: true,
  maintainAspectRatio: false,
  resizeDelay: 50,
  skipNull: skipNull.value,
  scales: {
    y: {
      stacked: true,
      ticks: {
        color: ticksColor.value,
      },
      grid: {
        color: gridColor.value,
      },
    },
    x: {
      stacked: true,
      ticks: {
        color: ticksColor.value,
      },
      grid: {
        display: false,
      },
    },
  },
  plugins: {
    legend: {
      display: true,
      labels: {
        color: labelsColor.value,
      },
    },
  },
}));

const doughnutChartOptions = computed<ChartOptions<'doughnut'>>(() => ({
  responsive: true,
  maintainAspectRatio: false,
  resizeDelay: 50,
  plugins: {
    legend: {
      labels: {
        color: labelsColor.value,
      },
    },
  },
}));
</script>

<template>
  <HtCard>
    <template #header>
      <h1>{{ $t('analytics.heading') }}</h1>
    </template>
    <p class="mb-2">
      {{ $t('analytics.description') }}
    </p>
    <p class="mb-2">
      {{ $t('analytics.collectionMethod') }}
    </p>
    <p v-if="lastUpdateTime">
      <HtTranslate i18n-key="analytics.lastUpdated">
        <template #1>
          <TimestampPreview
            :ts="lastUpdateTime"
            :format="MessageTimestampFormat.RELATIVE"
          />
        </template>
      </HtTranslate>
    </p>
  </HtCard>

  <HtCard class="analytics-card">
    <template #header>
      <h2>{{ $t('analytics.charts.dailyTotal') }}</h2>
    </template>
    <div class="analytics-chart-container analytics-chart-container-bar">
      <Bar
        :data="barChartData"
        :options="barChartOptions"
      />
    </div>
  </HtCard>

  <HtCard class="analytics-card">
    <template #header>
      <h2>{{ $t('analytics.charts.breakdown') }}</h2>
    </template>
    <HtFormCheckboxModelled
      v-if="devMode"
      id="skip-null"
      v-model="skipNull"
      :label="$t('analytics.charts.hideUnknown')"
      class="mb-2"
    />
    <div class="analytics-card-split">
      <div class="analytics-card-split-item">
        <h3>{{ $t('analytics.charts.byPage') }}</h3>
        <div class="analytics-chart-container analytics-chart-container-donut">
          <Doughnut
            :data="routeChartData"
            :options="doughnutChartOptions"
          />
        </div>
      </div>
      <div class="analytics-card-split-item">
        <h3>{{ $t('analytics.charts.byLanguage') }}</h3>
        <div class="analytics-chart-container analytics-chart-container-donut">
          <Doughnut
            :data="localeChartData"
            :options="doughnutChartOptions"
          />
        </div>
      </div>
    </div>
  </HtCard>
</template>
