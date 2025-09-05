<script setup lang="ts">

import { usageDataFetcherInject } from '@/injection-keys';
import { BotCommand } from '@/model/discord';
import BotCommandInfo from '@/Pages/BotInfo/BotCommandInfo.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { fetchUsageData } from '@/utils/app';
import { provide } from 'vue';

defineProps<{
  commands: BotCommand[];
  translations: Record<string, string>;
}>();

provide(usageDataFetcherInject, fetchUsageData);
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('botInfo.commandsReference.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.commandsReference.description') }}
    </p>

    <BotCommandInfo
      v-for="command in commands"
      :key="command.id"
      :command="command"
      :translations="translations"
    />
  </HtCard>
</template>

<style scoped>

</style>
