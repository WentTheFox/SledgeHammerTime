<script setup lang="ts">
import { CrowdinUserInfoProps } from '@/Components/CrowdinUserInfo.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCardForms from '@/Reusable/HtCardForms.vue';
import { computed } from 'vue';
import TranslationCreditOverrideEntry from './TranslationCreditOverrideEntry.vue';

const props = defineProps<{
  crowdinUsers: CrowdinUserInfoProps[];
  discordUsers: DiscordUserInfoProps[];
}>();

const allTranslators = computed(() =>
  props.crowdinUsers.flatMap(cu => cu.translators),
);
</script>

<template>
  <HtCard v-if="allTranslators.length > 0">
    <template #header>
      <h2>{{ $t('profile.creditOverrides.heading') }}</h2>

      <p class="mt-1">
        {{ $t('profile.creditOverrides.description') }}
      </p>

      <HtAlert
        type="warning"
        :closable="false"
        class="mt-3"
      >
        <template #text>
          {{ $t('profile.creditOverrides.reApprovalWarning') }}
        </template>
      </HtAlert>
    </template>

    <HtCardForms>
      <TranslationCreditOverrideEntry
        v-for="translator in allTranslators"
        :key="translator.id"
        :translator="translator"
        :crowdin-users="crowdinUsers"
        :discord-users="discordUsers"
      />
    </HtCardForms>
  </HtCard>
</template>
