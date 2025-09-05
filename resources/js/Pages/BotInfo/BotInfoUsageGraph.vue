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
  value: number;
}

const data = ref<BotInfoUsageData[] | null>(null);
const dtl = inject(dateTimeLibraryInject);

watch(() => [props.id, props.type], async () => {
  if (!usageDataFetcher) {
    data.value = [];
    return;
  }

  data.value = await usageDataFetcher(props);
}, { immediate: true });

const indexedData = computed<Record<string, number>>(() => data.value?.reduce((acc, c) => ({
  ...acc,
  [c.date]: c.value,
}), {}) ?? {});
const highestValue = computed(() => data.value?.reduce((acc, c) => c.value > acc ? c.value : acc, 0) ?? 0);

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
      value: indexedData.value[pastIsoDateString] ?? 0,
    });
  }
  return augmented;
});
</script>

<template>
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
        <div
          class="bot-usage-graph-line-fill"
          :style="`--value: ${dataPoint.value}`"
        />
        <template #content>
          <div class="bot-usage-graph-tooltip-usage">
            {{ dataPoint.value }}
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
</template>
