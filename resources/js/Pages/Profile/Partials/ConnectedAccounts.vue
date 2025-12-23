<script setup lang="ts">
import CrowdinUserInfo, { CrowdinUserInfoProps } from '@/Components/CrowdinUserInfo.vue';
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import ConnectedAccountsHeading from '@/Pages/Profile/Partials/ConnectedAccountsHeading.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { computed } from 'vue';

const props = defineProps<{
  discordUsers: DiscordUserInfoProps[];
  crowdinUsers: CrowdinUserInfoProps[];
}>();

const connectedAccountCount = computed(() => props.crowdinUsers.length + props.discordUsers.length);
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('profile.accounts.heading') }}</h2>
    </template>

    <p class="mt-1 mb-3">
      {{ $t('profile.accounts.description') }}
    </p>

    <section
      v-if="discordUsers.length > 0"
      class="connected-accounts-section"
    >
      <ConnectedAccountsHeading service="discord" />
      <DiscordUserInfo
        v-for="info of discordUsers"
        v-bind="info"
        :key="info.id"
      />
    </section>
    <section
      v-if="crowdinUsers.length > 0"
      class="connected-accounts-section"
    >
      <ConnectedAccountsHeading service="crowdin" />
      <CrowdinUserInfo
        v-for="info of crowdinUsers"
        v-bind="info"
        :key="info.id"
      />
    </section>
    <HtAlert
      v-if="connectedAccountCount === 0"
      type="info"
      :closable="false"
    >
      <template #text>
        {{ $t('profile.accounts.noConnectedAccounts') }}
      </template>
    </HtAlert>
  </HtCard>
</template>
