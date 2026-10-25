<script setup lang="ts">
import PageIcon from '@/Components/PageIcon.vue';

import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import AddAppLinks from '@/Pages/AddApp/AddAppLinks.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import HtOptimizedImage from '@/Reusable/HtOptimizedImage.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { PageName } from '@/utils/pages';
import { MISSING_ROUTE_HREF, safeRoute } from '@/utils/safe-route';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { faExternalLink } from '@fortawesome/free-solid-svg-icons';
import usefulLinksBotDark from '@img/useful-links/dark/bot.png';
import usefulLinksBotLight from '@img/useful-links/light/bot.png';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

const route = useRoute();
const page = inject(pagePropsInject);
const userInfo = computed(() => page?.value?.auth?.user);
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
const loginRoute = computed(() => safeRoute('login', route, { routeParams: routeParams.value }));


defineProps<{ discordAppId: string }>();
</script>

<template>
  <HtCard class="bot-info">
    <template #header>
      <HtOptimizedImage
        class="bot-info-image theme-dark-image"
        :src="usefulLinksBotDark"
      />
      <HtOptimizedImage
        class="bot-info-image theme-light-image"
        :src="usefulLinksBotLight"
      />
      <h1>
        <PageIcon
          :page="PageName.BotInfo"
          class="me-1"
        />
        {{ $t('botInfo.heading') }}
      </h1>
    </template>

    <p class="mb-3">
      {{ $t('botInfo.description') }}
    </p>
    <p class="mb-3">
      <HtTranslate
        v-if="userInfo"
        i18n-key="botInfo.customizeSettingsAuthenticated"
      >
        <template #1="slotProps">
          <Link
            :href="safeRoute('settings', route, {routeParams})"
            :async="false"
          >
            {{ slotProps.text }}
          </Link>
        </template>
      </HtTranslate>
      <HtTranslate
        v-else-if="loginRoute !== MISSING_ROUTE_HREF"
        i18n-key="botInfo.customizeSettingsGuest"
      >
        <template #1="slotProps">
          <a :href="loginRoute">
            {{ slotProps.text }}
          </a>
        </template>
        <template #3="slotProps">
          <a :href="safeRoute('settings', route, {routeParams})">
            {{ slotProps.text }}
          </a>
        </template>
      </HtTranslate>
    </p>
    <p class="mb-3">
      {{ $t('botInfo.addAppLead') }}
    </p>

    <AddAppLinks
      :horizontal="true"
      :open-in-new-tab="true"
    />
    <p class="mt-3 mb-3">
      {{ $t('botInfo.appDiscoveryLead') }}
    </p>
    <HtLinkButton
      :href="'https://discord.com/discovery/applications/'+discordAppId"
      :external="true"
      :target-blank="true"
      color="primary"
      :icon-start="faDiscord"
      :icon-end="faExternalLink"
    >
      {{ $t('botInfo.appDiscoveryCta') }}
    </HtLinkButton>
    <p class="mt-3 mb-3">
      {{ $t('botInfo.shareableLink') }}
    </p>
    <HtCopyableText
      :data="route('addBotNoLocale')"
      :monospace="false"
    />
  </HtCard>
</template>
