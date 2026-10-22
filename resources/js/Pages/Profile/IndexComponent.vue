<script setup lang="ts">
import { CrowdinUserInfoProps } from '@/Components/CrowdinUserInfo.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import ApiKeys, { ApiKeyInfo } from '@/Pages/Profile/Partials/ApiKeys.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import LinkAdditionalAccounts from '@/Pages/Profile/Partials/LinkAdditionalAccounts.vue';
import ProfileInfoCard from '@/Pages/Profile/Partials/ProfileInfoCard.vue';
import TranslationCreditsOverrides from '@/Pages/Profile/Partials/TranslationCreditsOverrides.vue';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

const props = defineProps<{
  discordUsers: DiscordUserInfoProps[];
  crowdinUsers: CrowdinUserInfoProps[];
  apiKeys: ApiKeyInfo[];
  apiKeyScopes: string[];
  maxApiKeys: number;
}>();

const latestCrowdinUsers = ref<CrowdinUserInfoProps[] | null>(null);

const effectiveCrowdinUsers = computed(() => latestCrowdinUsers.value ?? props.crowdinUsers);
</script>

<template>
  <Head :title="$t('profile.title')" />

  <Layout>
    <ProfileInfoCard />

    <UpdateProfileInformationForm />

    <TranslationCreditsOverrides
      :crowdin-users="effectiveCrowdinUsers"
      :discord-users="discordUsers"
      @success="latestCrowdinUsers = $event"
    />

    <ConnectedAccounts
      :discord-users="discordUsers"
      :crowdin-users="crowdinUsers"
    />

    <LinkAdditionalAccounts />

    <ApiKeys
      :api-keys="apiKeys"
      :scopes="apiKeyScopes"
      :max-keys="maxApiKeys"
      :discord-users="discordUsers"
    />

    <DeleteUserForm />
  </Layout>
</template>
