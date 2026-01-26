<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { useNativeLocaleNames } from '@/composables/useNativeLocaleNames';
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
import { useRoute } from 'ziggy-js';

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  ArcElement,
);

export interface DailyTotalItem {
  date: string;
  route: string;
  total: number;
}

export interface RouteBreakdownItem {
  route: string;
  total: number;
}

export interface LocaleBreakdownItem {
  locale: string;
  total: number;
}

export interface AnalyticsCardsProps {
  lastUpdated: string;
  dailyTotals: Array<DailyTotalItem>;
  routeBreakdown: Array<RouteBreakdownItem>;
  localeBreakdown: Array<LocaleBreakdownItem>;
}

interface DataIndex {
  dailyTotals: Record<string, Record<string, DailyTotalItem>>;
  routes: Set<string>;
  dates: Set<string>;
}

const props = defineProps<AnalyticsCardsProps>();
const unknownLabel = wTrans('analytics.values.unknown');
const TECHNICAL_ROUTES = new Set(['status']);

const skipNull = ref(true);
const skipTechnicalRoutes = ref(true);

const theme = inject(themeInject);
const devMode = inject(devModeInject);
const dtl = inject(dateTimeLibraryInject);
const lastUpdateTime = computed(() => props.lastUpdated ? dtl?.value.fromIsoString(props.lastUpdated) : undefined);
const route = useRoute();
const nativeLocaleNames = useNativeLocaleNames();

const getRouteLabel = (r: string) => r ? route(r, { locale: 'en' }, false).replace(/^(\/)en\/?|\?locale=en$/, '$1') : unknownLabel.value;
const getLocaleLabel = (l: string) => l ? (l in nativeLocaleNames ? `${nativeLocaleNames[l]} (${l})` : l) : unknownLabel.value;

const dataIndex = computed(() => props.dailyTotals.reduce((acc, d) => {
  const skip = skipTechnicalRoutes.value && TECHNICAL_ROUTES.has(d.route);
  if (!skip) {
    if (!(d.date in acc.dailyTotals)) {
      acc.dailyTotals[d.date] = {};
    }
    acc.dailyTotals[d.date][d.route] = d;
    acc.routes.add(d.route);
    acc.dates.add(d.date);
  }
  return acc;
}, { dailyTotals: {}, dates: new Set(), routes: new Set() } as DataIndex));

const barChartData = computed(() => {
  const routes = [...dataIndex.value.routes];
  const dates = [...dataIndex.value.dates].sort();
  const palette = generatePalette(routes.length, theme?.isLightTheme ?? true);

  const datasets = routes.map((route, index) => {
    return {
      label: getRouteLabel(route),
      backgroundColor: palette[index],
      data: dates.map(date => dataIndex.value.dailyTotals[date]?.[route]?.total ?? 0),
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

const filteredRouteBreakdown = computed(() => props.routeBreakdown.filter(r => (skipTechnicalRoutes.value ? !TECHNICAL_ROUTES.has(r.route) : true) && r.route !== null || !skipNull.value));

const routeChartData = computed(() => {
  return ({
    labels: filteredRouteBreakdown.value.map(r => getRouteLabel(r.route)),
    datasets: [
      {
        backgroundColor: generatePalette(props.routeBreakdown.length, theme?.isLightTheme ?? true),
        data: filteredRouteBreakdown.value.map((r) => r.total),
        borderWidth: 0,
      },
    ],
  });
});

const filteredLocaleBreakdown = computed(() => props.localeBreakdown.filter(l => l.locale !== null || !skipNull.value));

const localeChartData = computed(() => ({
  labels: filteredLocaleBreakdown.value.map((l) => l.locale),
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
    tooltip: {
      mode: 'index',
      callbacks: {
        title: (tooltipItems: { label: string }[]) => {
          const title = tooltipItems[0].label;
          const dateTotals = Object.values(dataIndex.value.dailyTotals[title] ?? {});
          if (!dateTotals || dateTotals.length === 0) {
            return title;
          }

          let total = dateTotals.reduce((sum, d) => sum + d.total, 0);
          return `${title} (${total})`;
        },
      },
    },
  },
}));

const byRouteChartOptions = computed<ChartOptions<'doughnut'>>(() => ({
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
const byLocaleChartOptions = computed<ChartOptions<'doughnut'>>(() => ({
  ...byRouteChartOptions.value,
  plugins: {
    ...byRouteChartOptions.value.plugins,
    tooltip: {
      callbacks: {
        title: (tooltipItems: { label: string }[]) => getLocaleLabel(tooltipItems[0].label),
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
    <p
      v-if="lastUpdateTime"
      class="mb-2"
    >
      <HtTranslate i18n-key="analytics.lastUpdated">
        <template #1>
          <TimestampPreview
            :ts="lastUpdateTime"
            :format="MessageTimestampFormat.RELATIVE"
          />
        </template>
      </HtTranslate>
    </p>
    <HtFormCheckboxModelled
      v-if="devMode"
      id="skip-null"
      v-model="skipNull"
      label="Hide unknown values"
      class="mb-2"
    />
    <HtFormCheckboxModelled
      v-if="devMode"
      id="skip-technical-routes"
      v-model="skipTechnicalRoutes"
      label="Skip technical routes"
      class="mb-2"
    />
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
    <div class="analytics-card-split">
      <div class="analytics-card-split-item">
        <h3>{{ $t('analytics.charts.byPage') }}</h3>
        <div class="analytics-chart-container analytics-chart-container-donut">
          <Doughnut
            :data="routeChartData"
            :options="byRouteChartOptions"
          />
        </div>
      </div>
      <div class="analytics-card-split-item">
        <h3>{{ $t('analytics.charts.byLanguage') }}</h3>
        <div class="analytics-chart-container analytics-chart-container-donut">
          <Doughnut
            :data="localeChartData"
            :options="byLocaleChartOptions"
          />
        </div>
      </div>
    </div>
  </HtCard>
</template>
