<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import { BotCommand } from '@/model/discord';
import BotInfoCard from '@/Pages/BotInfo/BotInfoCard.vue';
import CommandsReference from '@/Pages/BotInfo/CommandsReference.vue';
import WebhookDeliveryStats, { WebhookDeliveryStatsPoint } from '@/Pages/BotInfo/WebhookDeliveryStats.vue';
import { BotCommandTranslation, getBotCommandTranslationKey } from '@/utils/translation';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { useIntervalFn } from '@vueuse/core';
import { computed, onMounted, ref } from 'vue';

const props = defineProps<{
  discordAppId: string;
  commands: BotCommand[];
  translations: BotCommandTranslation[];
  webhookDeliveryStatsWindowHours: number;
}>();

const webhookDeliveryStats = ref<WebhookDeliveryStatsPoint[] | null>(null);
const webhookDeliveryStatsRefreshIntervalMs = 30_000;

const fetchWebhookDeliveryStats = async () => {
  try {
    const { data } = await axios.get<WebhookDeliveryStatsPoint[]>('/frontend/webhook-delivery-stats');
    webhookDeliveryStats.value = data;
  } catch {
    webhookDeliveryStats.value ??= [];
  }
};

onMounted(fetchWebhookDeliveryStats);
// Keeps the chart live while the page is left open, without the visitor having to reload.
useIntervalFn(fetchWebhookDeliveryStats, webhookDeliveryStatsRefreshIntervalMs);

const flatTranslations = computed(() => props.translations.reduce((acc, translation) => {
  return ({
    ...acc,
    [getBotCommandTranslationKey(translation)]: translation.value,
  });
}, {} as Record<string, string>));
</script>

<template>
  <Head :title="$t('botInfo.heading')" />

  <Layout>
    <BotInfoCard :discord-app-id="discordAppId" />

    <WebhookDeliveryStats
      :stats="webhookDeliveryStats"
      :window-hours="webhookDeliveryStatsWindowHours"
    />

    <CommandsReference
      :commands="commands"
      :translations="flatTranslations"
    />
  </Layout>
</template>
