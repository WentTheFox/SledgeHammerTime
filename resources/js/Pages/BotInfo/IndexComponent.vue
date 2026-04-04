<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import { BotCommand } from '@/model/discord';
import BotInfoCard from '@/Pages/BotInfo/BotInfoCard.vue';
import BotShards, { BotShardData } from '@/Pages/BotInfo/BotShards.vue';
import CommandsReference from '@/Pages/BotInfo/CommandsReference.vue';
import { BotCommandTranslation, getBotCommandTranslationKey } from '@/utils/translation';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';

const props = defineProps<{
  discordAppId: string;
  commands: BotCommand[];
  translations: BotCommandTranslation[];
}>();

const shards = ref<BotShardData | null>(null);

onMounted(async () => {
  try {
    const { data } = await axios.get<BotShardData>('/frontend/shards');
    shards.value = data;
  } catch {
    shards.value = [];
  }
});

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

    <BotShards :shards="shards" />

    <CommandsReference
      :commands="commands"
      :translations="flatTranslations"
    />
  </Layout>
</template>
