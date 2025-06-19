<script setup lang="ts">
import { CrowdinUserInfoProps } from '@/Components/CrowdinUserInfo.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import LinkAdditionalAccounts from '@/Pages/Profile/Partials/LinkAdditionalAccounts.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { Head } from '@inertiajs/vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
  discordUsers: DiscordUserInfoProps[];
  crowdinUsers: CrowdinUserInfoProps[];
}>();
</script>

<template>
  <Head :title="$t('profile.title')" />

  <Layout>
    <HtCard>
      <template #header>
        <h2>{{ $t('profile.title') }}</h2>
      </template>
    </HtCard>

    <UpdateProfileInformationForm />

    <ConnectedAccounts
      :discord-users="discordUsers"
      :crowdin-users="crowdinUsers"
    />

    <LinkAdditionalAccounts />

    <DeleteUserForm />
  </Layout>
</template>
