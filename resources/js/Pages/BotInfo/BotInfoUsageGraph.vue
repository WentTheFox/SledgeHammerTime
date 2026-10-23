<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import {
  BotInfoUsageData,
  BotInfoUsageFetchOptions,
  dateTimeLibraryInject,
  usageDataFetcherInject,
} from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import { DailyUsage, groupUsageByDay, sourcesInUse, withoutSources } from '@/utils/usage-series';
import { faCalendar } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject, ref, watch } from 'vue';
import { Tippy, TippySingleton } from 'vue-tippy';

export type BotInfoUsageGraphProps = BotInfoUsageFetchOptions;

const props = defineProps<BotInfoUsageGraphProps>();
const usageDataFetcher = inject(usageDataFetcherInject);
const historyDays = 90;

interface AugmentedBotInfoUsageData {
  key: number;
  timestamp: DateTimeLibraryValue;
  usage: DailyUsage;
}

const NO_USAGE: DailyUsage = { total: 0, bySource: [] };

const data = ref<BotInfoUsageData[] | null>(null);
const dtl = inject(dateTimeLibraryInject);

watch(() => [props.id, props.type], async () => {
  if (!usageDataFetcher) {
    data.value = [];
    return;
  }

  data.value = await usageDataFetcher(props);
}, { immediate: true });

const allUsageByDay = computed(() => groupUsageByDay(data.value ?? []));
// The legend is only there when there is something to tell apart, and it keeps the sources that are switched off
const sources = computed(() => sourcesInUse(allUsageByDay.value.values()));

// Clicking a source in the legend switches it off or on
const hiddenSources = ref<ReadonlySet<string>>(new Set());
const toggleSource = (source: string) => {
  const next = new Set(hiddenSources.value);
  if (!next.delete(source)) next.add(source);
  hiddenSources.value = next;
};

const usageByDay = computed(() => withoutSources(allUsageByDay.value, hiddenSources.value));
// The tallest day sets the height, so the stacked sources of a day add up to its share of it
const highestValue = computed(() => Math.max(0, ...[...usageByDay.value.values()].map(day => day.total)));

const augmentedData = computed(() => {
  let augmented: AugmentedBotInfoUsageData[] = [];
  const now = dtl?.value.now();
  if (!now) return augmented;
  for (let i = -historyDays; i < 0; i++) {
    const pastDate = now.addDays(i + 1);
    const pastIsoDateString = pastDate.toISODateString();
    augmented.push({
      key: pastDate.getUnixSeconds(),
      timestamp: pastDate,
      usage: usageByDay.value.get(pastIsoDateString) ?? NO_USAGE,
    });
  }
  return augmented;
});
</script>

<template>
  <div class="bot-usage">
    <TippySingleton>
      <div
        class="bot-usage-graph"
        :style="`--highest-value: ${highestValue}`"
      >
        <div
          v-if="data === null || data.length === 0"
          class="bot-usage-graph-legend bot-usage-graph-no-data"
        >
          <span class="bot-usage-graph-legend-label bot-usage-graph-no-data-label">
            <HtLoadingIndicator v-if="data === null" />
            <template v-else>
              {{ $t('botInfo.commandsReference.usageGraphNoData') }}
            </template>
          </span>
        </div>
        <div
          v-else
          class="bot-usage-graph-legend"
        >
          <span class="bot-usage-graph-legend-label high">
            {{ highestValue }}
          </span>
          <span class="bot-usage-graph-legend-label low">
            0
          </span>
        </div>
        <Tippy
          v-for="dataPoint in augmentedData"
          :key="dataPoint.key"
          :follow-cursor="true"
          class="bot-usage-graph-line"
          :animation="false"
        >
          <template v-if="dataPoint.usage.bySource.length > 0">
            <div
              v-for="entry in dataPoint.usage.bySource"
              :key="entry.source"
              :class="['bot-usage-graph-line-fill', `source-${entry.source}`]"
              :style="`--value: ${entry.value}`"
            />
          </template>
          <div
            v-else
            class="bot-usage-graph-line-fill"
            style="--value: 0"
          />
          <template #content>
            <div class="bot-usage-graph-tooltip-usage">
              {{ dataPoint.usage.total }}
            </div>
            <div
              v-if="sources.length > 1 && dataPoint.usage.bySource.length > 0"
              class="bot-usage-graph-tooltip-sources"
            >
              <div
                v-for="entry in dataPoint.usage.bySource"
                :key="entry.source"
                class="bot-usage-graph-tooltip-source"
              >
                <span :class="['bot-usage-graph-source-swatch', `source-${entry.source}`]" />
                {{ $t(`botInfo.commandsReference.usageSources.${entry.source}`) }}: {{ entry.value }}
              </div>
            </div>
            <div class="bot-usage-graph-tooltip-date">
              <FontAwesomeIcon
                :icon="faCalendar"
                class="me-2"
              />
              <TimestampPreview
                :ts="dataPoint.timestamp"
                :format="MessageTimestampFormat.SHORT_DATE"
              />
            </div>
          </template>
        </Tippy>
      </div>
    </TippySingleton>
    <ul
      v-if="sources.length > 1"
      class="bot-usage-graph-sources"
    >
      <li
        v-for="source in sources"
        :key="source"
      >
        <button
          type="button"
          :class="['bot-usage-graph-source', { off: hiddenSources.has(source) }]"
          :aria-pressed="!hiddenSources.has(source)"
          @click="toggleSource(source)"
        >
          <span :class="['bot-usage-graph-source-swatch', `source-${source}`]" />
          {{ $t(`botInfo.commandsReference.usageSources.${source}`) }}
        </button>
      </li>
    </ul>
  </div>
</template>
