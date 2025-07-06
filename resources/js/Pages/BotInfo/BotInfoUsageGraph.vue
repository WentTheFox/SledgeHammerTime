<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { dateTimeLibraryInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtLoadingIndicator from '@/Reusable/HtLoadingIndicator.vue';
import { faCalendar } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';
import { computed, inject, ref, watch } from 'vue';
import { Tippy, TippySingleton } from 'vue-tippy';

export interface BotInfoUsageGraphProps {
  id: string;
  type: 'command' | 'option';
}

const props = defineProps<BotInfoUsageGraphProps>();

interface BotInfoUsageData {
  date: string;
  value: number;
}

interface AugmentedBotInfoUsageData {
  timestamp: number;
  value: number;
}

const data = ref<BotInfoUsageData[] | null>(null);
const dtl = inject(dateTimeLibraryInject);

watch(() => [props.id, props.type], async () => {
  const params = new URLSearchParams();
  params.set('id', props.id);
  params.set('type', props.type);
  const result = await axios.get(route('app.usage') + '?' + params);
  data.value = result.data as BotInfoUsageData[];
}, { immediate: true });

const indexedData = computed<Record<string, number>>(() => data.value?.reduce((acc, c) => ({
  ...acc,
  [c.date]: c.value,
}), {}) ?? {});
const biggestDataPoint = computed(() => data.value?.reduce((acc, c) => c.value > acc ? c.value : acc, 0) ?? 0);

const augmentedData = computed(() => {
  if (data.value == null) return null;

  let augmented: AugmentedBotInfoUsageData[] = [];
  const now = dtl?.value.now();
  if (!now) return augmented;
  for (let i = -30; i < 0; i++) {
    const pastDate = now.addDays(i + 1);
    const pastIsoDateString = pastDate.toISODateString();
    augmented.push({
      timestamp: pastDate.getUnixSeconds(),
      value: indexedData.value[pastIsoDateString] ?? 0,
    });
  }
  return augmented;
});

watch(data, (newData) => {
  if (!newData) return;
});
</script>

<template>
  <template v-if="!augmentedData">
    <HtLoadingIndicator />
  </template>
  <template v-else>
    <TippySingleton>
      <div
        class="bot-usage-graph"
        :style="`--highest-value: ${biggestDataPoint}`"
      >
        <div
          v-if="!data || data.length === 0"
          class="bot-usage-graph-no-data"
        >
          <span class="bot-usage-graph-no-data-label">
            {{ $t('botInfo.commandsReference.usageGraphNoData') }}
          </span>
        </div>
        <Tippy
          v-for="dataPoint in augmentedData"
          :key="dataPoint.timestamp"
          :follow-cursor="true"
          class="bot-usage-graph-line"
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
                :ts="dtl?.fromTimestampMsUtc(dataPoint.timestamp)"
                :format="MessageTimestampFormat.SHORT_DATE"
              />
            </div>
          </template>
        </Tippy>
      </div>
    </TippySingleton>
  </template>
</template>
