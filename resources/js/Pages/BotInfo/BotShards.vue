<script setup lang="ts">
import { useNumberFormatter } from '@/composables/useNumberFormatter';
import BotShardsDisplay, { BotShard } from '@/Pages/BotInfo/BotShardsDisplay.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { computed } from 'vue';

export type BotShardData = BotShard[];

const props = defineProps<{
  shards: BotShardData | null;
}>();
const nf = useNumberFormatter();
const totalServerCountNumber = computed(() => (props.shards ?? []).reduce((total, shard) => total + shard.serverCount, 0));
const totalServerCount = computed(() => (
  totalServerCountNumber.value > 0
    ? nf.value.format(totalServerCountNumber.value)
    : '…'
));
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('botInfo.shardStats.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.shardStats.description') }}
    </p>

    <p class="mb-3">
      {{ $t('botInfo.shardStats.boxesDescription', { totalServerCount }) }}
    </p>

    <BotShardsDisplay :shards="shards" />
  </HtCard>
</template>
