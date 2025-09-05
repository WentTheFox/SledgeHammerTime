<script setup lang="ts">
import { BotInfoUsageData, usageDataFetcherInject, UsageDataFetchFunction } from '@/injection-keys';
import { BotCommand, BotCommandOption, DiscordBotCommandOptionType, DiscordBotCommandType } from '@/model/discord';
import BotCommandInfo from '@/Pages/BotInfo/BotCommandInfo.vue';
import { randomlyGenerateCommandUsageData } from '@/utils/app';
import { provide } from 'vue';

const upToSuffix = ', up to 100 characters long';
const getStaticCommandOptions = (deleted: boolean = false): BotCommandOption[] => {
  const deleted_at = deleted ? new Date().toISOString() : null;
  return [
    {
      id: 'subcommand',
      type: DiscordBotCommandOptionType.SUB_COMMAND,
      name: 'subcommand',
      description: `Subcommand option description${upToSuffix}`,
      min_length: null,
      max_length: null,
      min_value: null,
      max_value: null,
      required: false,
      total_uses: Math.round(Math.random() * 5e3),
      deleted_at,
    },
    {
      id: 'string',
      type: DiscordBotCommandOptionType.STRING,
      name: 'string',
      description: `String option description${upToSuffix}`,
      min_length: 0,
      max_length: 64,
      min_value: null,
      max_value: null,
      required: true,
      total_uses: Math.round(Math.random() * 5e3),
      deleted_at,
    },
    {
      id: 'integer',
      type: DiscordBotCommandOptionType.INTEGER,
      name: 'integer',
      description: `Integer option description${upToSuffix}`,
      min_length: null,
      max_length: null,
      min_value: 0,
      max_value: 99999,
      required: true,
      total_uses: Math.round(Math.random() * 5e3),
      deleted_at,
    },
    {
      id: 'boolean',
      type: DiscordBotCommandOptionType.BOOLEAN,
      name: 'boolean',
      description: `Boolean option description${upToSuffix}`,
      min_length: null,
      max_length: null,
      min_value: null,
      max_value: null,
      required: false,
      total_uses: Math.round(Math.random() * 5e3),
      deleted_at,
    },
    {
      id: 'number',
      type: DiscordBotCommandOptionType.NUMBER,
      name: 'number',
      description: `Number option description${upToSuffix}`,
      min_length: null,
      max_length: null,
      min_value: 0.001,
      max_value: 99999.999,
      required: false,
      total_uses: Math.round(Math.random() * 5e3),
      deleted_at,
    },
  ];
};
const staticCommands: BotCommand[] = [
  {
    id: 'slash-command',
    name: 'slash-command',
    type: DiscordBotCommandType.ChatInput,
    description: `Slash command description${upToSuffix}`,
    options: getStaticCommandOptions(),
    total_executions: Math.round(Math.random() * 10e3),
  },
  {
    id: 'slash-command-with-deleted-options',
    name: 'slash-command-with-deleted-options',
    type: DiscordBotCommandType.ChatInput,
    description: `Slash command description${upToSuffix}`,
    options: getStaticCommandOptions(true),
    total_executions: Math.round(Math.random() * 10e3),
  },
  {
    id: 'user-command',
    name: 'User command',
    type: DiscordBotCommandType.User,
    description: `User command description${upToSuffix}`,
    total_executions: Math.round(Math.random() * 10e3),
  },
  {
    id: 'message-command',
    name: 'Message command',
    type: DiscordBotCommandType.Message,
    description: `Message command description${upToSuffix}`,
    total_executions: Math.round(Math.random() * 10e3),
  },
];
const staticTranslations: Record<string, string> = {};
const usageDataGenerator: UsageDataFetchFunction = (options) => {
  const subject = options.type === 'command'
    ? staticCommands.find(c => c.id === options.id)
    : staticCommands.flatMap(c => c.options ?? []).find(o => o.id === options.id);
  let results: BotInfoUsageData[] = [];
  if (subject) {
    const totalCount = ('total_uses' in subject ? subject.total_uses : subject.total_executions) ?? 0;
    results = randomlyGenerateCommandUsageData(totalCount);
  }
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(results);
    }, 250 + (Math.random() * 250));
  });
};
provide(usageDataFetcherInject, usageDataGenerator);
</script>

<template>
  <p class="mt-3 mb-3">
    Command reference
  </p>
  <BotCommandInfo
    v-for="command in staticCommands"
    :key="command.id"
    :command="command"
    :translations="staticTranslations"
  />
</template>
