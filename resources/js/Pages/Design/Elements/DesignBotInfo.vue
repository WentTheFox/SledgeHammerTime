<script setup lang="ts">

import BotShardsDisplay, { BotShard } from '@/Pages/BotInfo/BotShardsDisplay.vue';
import DesignBotInfoCommandsReference from '@/Pages/Design/Elements/DesignBotInfoCommandsReference.vue';
import DesignBotInfoUsageGraph from '@/Pages/Design/Elements/DesignBotInfoUsageGraph.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { faPlus, faRefresh } from '@fortawesome/free-solid-svg-icons';
import { ref } from 'vue';

const baseMemberCount = 1000;
const memberCountVariance = baseMemberCount * .75;
const getRandomShard = (shardsValue: BotShard[] = []): BotShard => ({
  id: shardsValue.length,
  serverCount: Math.round((baseMemberCount) - (Math.random() * memberCountVariance)),
  memberCount: null,
  startedAt: new Date().toISOString(),
  createdAt: new Date().toISOString(),
  updatedAt: new Date().toISOString(),
});

const shards = ref<BotShard[]>([getRandomShard()]);

const addShard = () => {
  shards.value = shards.value.concat(getRandomShard(shards.value));
};
const resetShards = () => {
  shards.value = [getRandomShard()];
};
</script>

<template>
  <HtCard>
    <template #header>
      <h2>Bot Info</h2>
    </template>

    <p class="mb-3">
      Shards
    </p>
    <BotShardsDisplay :shards="shards" />
    <div class="mt-2">
      <HtButton
        color="primary"
        :icon-start="faPlus"
        @click="addShard"
      >
        Add randomized shard
      </HtButton>
      &nbsp;
      <HtButton
        color="danger"
        :icon-start="faRefresh"
        @click="resetShards"
      >
        Reset shards
      </HtButton>
    </div>

    <DesignBotInfoCommandsReference />

    <DesignBotInfoUsageGraph />
  </HtCard>
</template>
