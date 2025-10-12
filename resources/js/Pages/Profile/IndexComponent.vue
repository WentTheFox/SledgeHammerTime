<script setup lang="ts">
import { CrowdinUserInfoProps } from '@/Components/CrowdinUserInfo.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import { useRoute } from '@/composables/useRoute';
import Layout from '@/Layouts/DefaultLayout.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import LinkAdditionalAccounts from '@/Pages/Profile/Partials/LinkAdditionalAccounts.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { Head, Link } from '@inertiajs/vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
  discordUsers: DiscordUserInfoProps[];
  crowdinUsers: CrowdinUserInfoProps[];
}>();

const route = useRoute();
</script>

<template>
  <Head :title="$t('profile.title')" />

  <Layout>
    <HtCard class="profile-info">
      <template #header>
        <h2>{{ $t('profile.title') }}</h2>
      </template>
      <p>
        <HtTranslate i18n-key="profile.intro">
          <template #1="slotProps">
            <Link :href="route('settings', route().params)">
              {{ slotProps.text }}
            </Link>
          </template>
        </HtTranslate>
      </p>
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

<style lang="scss">
@use "../../../css/design";

.profile-info p {
  @include design.content-link-style;
}
</style>
