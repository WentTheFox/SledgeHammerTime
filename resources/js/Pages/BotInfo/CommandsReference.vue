<script setup lang="ts">

import { useRoute } from '@/composables/useRoute';
import { usageDataFetcherInject } from '@/injection-keys';
import { BotCommand } from '@/model/discord';
import BotCommandInfo from '@/Pages/BotInfo/BotCommandInfo.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { usageDataFetcherFactory } from '@/utils/app';
import { provide } from 'vue';

defineProps<{
  commands: BotCommand[];
  translations: Record<string, string>;
}>();

const route = useRoute();
provide(usageDataFetcherInject, usageDataFetcherFactory(route('app.usage')));
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
      :additional-description="$t(`botInfo.commandsReference.additionalDescription.commands.${command.name}`)"
      :translations="translations"
    />
  </HtCard>
</template>

<style scoped>

</style>
