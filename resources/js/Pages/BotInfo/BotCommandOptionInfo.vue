<script setup lang="ts">
import BotCommandOptionChoices, { BotCommandOptionChoiceList } from '@/Pages/BotInfo/BotCommandOptionChoices.vue';
import BotInfoUsageBadge from '@/Pages/BotInfo/BotInfoUsageBadge.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { BadgeColor } from '@/utils/badges';
import { getBotCommandTranslationKey } from '@/utils/translation';
import { computed } from 'vue';

export interface BotCommandOption {
  id: string;
  name: string;
  description: string;
  type: number;
  required: boolean | null;
  min_value: number | null;
  max_value: number | null;
  min_length: number | null;
  max_length: number | null;
  choices?: BotCommandOptionChoiceList;
  total_uses: number | null;
  deleted_at: string | null;
}

const props = defineProps<{
  commandId: string,
  option: BotCommandOption,
  translations: Record<string, string>,
}>();

const localizedName = computed(() => {
  const key = getBotCommandTranslationKey({
    commandId: props.commandId,
    optionId: props.option.id,
    field: 'name',
  });

  return props.translations[key] ?? props.option.name;
});
const localizedDescription = computed(() => {
  const key = getBotCommandTranslationKey({
    commandId: props.commandId,
    optionId: props.option.id,
    field: 'description',
  });

  return props.translations[key] ?? props.option.description;
});

const optionColors: Partial<Record<number, BadgeColor>> = {
  1: 'purple',
  4: 'blue',
  5: 'green',
  10: 'cyan',
};

const hasMinValue = computed(() => typeof props.option.min_value === 'number');
const hasMaxValue = computed(() => typeof props.option.max_value === 'number');
const hasMinLength = computed(() => typeof props.option.min_length === 'number');
const hasMaxLength = computed(() => typeof props.option.max_length === 'number');
const totalUses = computed(() => props.option.total_uses ?? 0);
const isDeleted = computed(() => props.option.deleted_at !== null);
</script>

<template>
  <dt :class="['bot-command-option-name', { required: option.required, deleted: isDeleted }]">
    {{ localizedName }}
  </dt>
  <dd :class="['bot-command-option-details', { deleted: isDeleted }]">
    <p class="bot-command-option-description mb-2">
      {{ localizedDescription }}
    </p>
    <HtBadgeGroup class="bot-command-option-badges mb-2">
      <HtBadge
        v-if="isDeleted"
        color="muted"
      >
        {{ $t('botInfo.commandsReference.removedOption') }}
      </HtBadge>
      <HtBadge
        :prefix="$t('botInfo.commandsReference.optionType')"
        :color="optionColors[option.type]"
      >
        {{ $t('botInfo.commandsReference.optionTypes.' + option.type) }}
      </HtBadge>
      <HtBadge
        v-if="option.required"
        color="red"
      >
        {{ $t('botInfo.commandsReference.requiredOption') }}
      </HtBadge>
      <template v-if="hasMinValue && hasMaxValue">
        <HtBadge
          :color="optionColors[option.type]"
          :prefix="$t('botInfo.commandsReference.values')"
        >
          <HtTranslate i18n-key="botInfo.commandsReference.valuesBetween">
            <template #0>
              <code>{{ option.min_value }}</code>
            </template>
            <template #2>
              <code>{{ option.max_value }}</code>
            </template>
          </HtTranslate>
        </HtBadge>
      </template>
      <template v-else>
        <HtBadge
          v-if="hasMinValue"
          :color="optionColors[option.type]"
          :prefix="$t('botInfo.commandsReference.minValue')"
        >
          <code>{{ option.min_value }}</code>
        </HtBadge>
        <HtBadge
          v-if="hasMaxValue"
          :color="optionColors[option.type]"
          :prefix="$t('botInfo.commandsReference.maxValue')"
        >
          <code>{{ option.max_value }}</code>
        </HtBadge>
      </template>
      <template v-if="hasMinLength && hasMaxLength">
        <HtBadge
          :color="optionColors[option.type]"
          :prefix="$t('botInfo.commandsReference.length')"
        >
          <HtTranslate i18n-key="botInfo.commandsReference.lengthBetween">
            <template #0>
              <code>{{ option.min_length }}</code>
            </template>
            <template #2>
              <code>{{ option.max_length }}</code>
            </template>
          </HtTranslate>
        </HtBadge>
      </template>
      <template v-else>
        <HtBadge
          v-if="typeof option.min_length === 'number'"
          :prefix="$t('botInfo.commandsReference.minLength')"
        >
          <code>{{ option.min_length }}</code>
        </HtBadge>
        <HtBadge
          v-if="typeof option.max_length === 'number'"
          :prefix="$t('botInfo.commandsReference.maxLength')"
        >
          <code>{{ option.max_length }}</code>
        </HtBadge>
      </template>
      <BotInfoUsageBadge
        :id="option.id"
        type="option"
        :title="$t('botInfo.commandsReference.totalUses')"
        :total-usage="totalUses"
      />
    </HtBadgeGroup>
    <BotCommandOptionChoices
      v-if="option.choices && option.choices.length > 0"
      :command-id="commandId"
      :option-id="option.id"
      :choices="option.choices"
      :translations="translations"
    />
  </dd>
</template>
