<script setup lang="ts">
import { CrowdinUserInfoProps } from '@/Components/CrowdinUserInfo.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import Layout from '@/Layouts/DefaultLayout.vue';
import ConnectedAccounts from '@/Pages/Profile/Partials/ConnectedAccounts.vue';
import LinkAdditionalAccounts from '@/Pages/Profile/Partials/LinkAdditionalAccounts.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { safeRoute } from '@/utils/safe-route';
import { faUserGear } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Head, Link } from '@inertiajs/vue3';
import { inject } from 'vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
  discordUsers: DiscordUserInfoProps[];
  crowdinUsers: CrowdinUserInfoProps[];
}>();

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
</script>

<template>
  <Head :title="$t('profile.title')" />

  <Layout>
    <HtCard class="profile-info">
      <template #header>
        <h2>
          <FontAwesomeIcon
            :icon="faUserGear"
            class="me-1"
          />
          {{ $t('profile.title') }}
        </h2>
      </template>
      <p>
        <HtTranslate i18n-key="profile.intro">
          <template #1="slotProps">
            <Link :href="safeRoute('settings', route, routeParams)">
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
