<script setup lang="ts">

import { BotCommand, DiscordBotCommandType } from '@/model/discord';
import BotCommandOptionInfo from '@/Pages/BotInfo/BotCommandOptionInfo.vue';
import BotInfoUsageBadge from '@/Pages/BotInfo/BotInfoUsageBadge.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import { getBotCommandTranslationKey } from '@/utils/translation';
import { computed } from 'vue';

const props = defineProps<{
  command: BotCommand,
  additionalDescription?: string,
  translations: Record<string, string>,
}>();

const localizedName = computed(() => {
  const key = getBotCommandTranslationKey({
    commandId: props.command.id,
    field: 'name',
  });

  return props.translations[key] ?? props.command.name;
});
const localizedDescription = computed(() => {
  const key = getBotCommandTranslationKey({
    commandId: props.command.id,
    field: 'description',
  });

  return props.translations[key] ?? props.command.description;
});
const hasAdditionalDescription = computed(() => !!props.additionalDescription && !props.additionalDescription.startsWith('botInfo.'));
const hasDescription = computed(() => localizedDescription.value || hasAdditionalDescription);
const totalExecutions = computed(() => props.command.total_executions ?? 0);
</script>

<template>
  <div class="bot-command-info">
    <h3 class="bot-command-name">
      {{ (command.type === DiscordBotCommandType.ChatInput ? '/' : '') + localizedName }}
      <small class="bot-command-type" />
    </h3>

    <HtBadgeGroup>
      <HtBadge
        color="purple"
        :prefix="$t('botInfo.commandsReference.commandType')"
      >
        {{ $t('botInfo.commandsReference.commandTypeNames.' + command.type) }}
      </HtBadge>
      <BotInfoUsageBadge
        :id="command.id"
        type="command"
        :title="$t('botInfo.commandsReference.totalExecutions')"
        :total-usage="totalExecutions"
      />
    </HtBadgeGroup>

    <template v-if="hasDescription">
      <template v-if="localizedDescription">
        <h4>
          {{ $t('botInfo.commandsReference.shortDescription') }}
        </h4>
        <p>
          {{ localizedDescription }}
        </p>
      </template>
      <HtAlert
        v-if="hasAdditionalDescription"
        :closable="false"
        type="info"
      >
        <template #text>
          {{ additionalDescription }}
        </template>
      </HtAlert>
    </template>

    <template v-if="command.options && command.options.length > 0">
      <h4>{{ $t('botInfo.commandsReference.commandOptions') }}</h4>

      <dl class="bot-command-options">
        <BotCommandOptionInfo
          v-for="option in command.options"
          :key="option.id"
          :command-id="command.id"
          :option="option"
          :translations="translations"
        />
      </dl>
    </template>
  </div>
</template>
