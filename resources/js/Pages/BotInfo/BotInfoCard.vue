<script setup lang="ts">

import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import AddAppLinks from '@/Pages/AddApp/AddAppLinks.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import HtOptimizedImage from '@/Reusable/HtOptimizedImage.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { safeRoute } from '@/utils/safe-route';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { faExternalLink, faRobot } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import usefulLinksBot from '@img/useful-links/bot.png';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

const route = useRoute();
const page = inject(pagePropsInject);
const userInfo = computed(() => page?.value?.auth?.user);
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);


defineProps<{ discordAppId: string }>();
</script>

<template>
  <HtCard class="bot-info">
    <template #header>
      <HtOptimizedImage
        class="bot-info-image"
        :src="usefulLinksBot"
      />
      <h2>
        <FontAwesomeIcon
          :icon="faRobot"
          class="me-1"
        />
        {{ $t('botInfo.heading') }}
      </h2>
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
            :href="safeRoute('settings', route, routeParams)"
            :async="false"
          >
            {{ slotProps.text }}
          </Link>
        </template>
      </HtTranslate>
      <HtTranslate
        v-else
        i18n-key="botInfo.customizeSettingsGuest"
      >
        <template #1="slotProps">
          <a :href="safeRoute('login', route, routeParams)">
            {{ slotProps.text }}
          </a>
        </template>
        <template #3="slotProps">
          <a :href="safeRoute('settings', route, routeParams)">
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
