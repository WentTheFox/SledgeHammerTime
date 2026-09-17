<script setup lang="ts">

import DesignBotInfoCommandsReference from '@/Pages/Design/Elements/DesignBotInfoCommandsReference.vue';
import DesignBotInfoUsageGraph from '@/Pages/Design/Elements/DesignBotInfoUsageGraph.vue';
import DesignWebhookDeliveryStats from '@/Pages/Design/Elements/DesignWebhookDeliveryStats.vue';
import HtCard from '@/Reusable/HtCard.vue';
</script>

<template>
  <HtCard>
    <template #header>
      <h2>Bot Info</h2>
    </template>

    <DesignBotInfoCommandsReference />

    <DesignBotInfoUsageGraph />

    <DesignWebhookDeliveryStats />
  </HtCard>
</template>
