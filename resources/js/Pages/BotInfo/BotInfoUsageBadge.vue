<script setup lang="ts">
import { useNumberFormatter } from '@/composables/useNumberFormatter';
import BotInfoUsageGraph, { BotInfoUsageGraphProps } from '@/Pages/BotInfo/BotInfoUsageGraph.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import { faChartLine } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { ref } from 'vue';
import { Tippy } from 'vue-tippy';

defineProps<BotInfoUsageGraphProps & {
  title: string,
  totalUsage: number,
}>();

const nf = useNumberFormatter();

const shown = ref(false);
</script>

<template>
  <Tippy
    :interactive="true"
    theme="bot-info-usage"
    @show="shown = true"
  >
    <HtBadge
      :color="totalUsage > 0 ? undefined : 'muted'"
      :title="title"
    >
      <FontAwesomeIcon :icon="faChartLine" />
      {{ nf.format(totalUsage) }}
    </HtBadge>
    <template #content>
      <BotInfoUsageGraph
        v-if="shown"
        :id="id"
        :type="type"
      />
    </template>
  </Tippy>
</template>
