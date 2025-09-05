<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { currentLanguageInject, devModeInject } from '@/injection-keys';
import ConnectedAccountsHeading from '@/Pages/Profile/Partials/ConnectedAccountsHeading.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { computed, inject } from 'vue';

const route = useRoute();

const devMode = inject(devModeInject);
const currentLanguage = inject(currentLanguageInject);
const locale = computed(() => currentLanguage?.value.locale ?? FALLBACK_LANGUAGE);
</script>

<template>
  <HtCard>
    <template #header>
      <h2>
        {{ $t('profile.accounts.linkAdditional.heading') }}
      </h2>
    </template>
    <p class="mt-1 mb-3">
      {{ $t('profile.accounts.linkAdditional.description') }}
    </p>

    <section
      v-if="devMode"
      class="mb-3"
    >
      <ConnectedAccountsHeading service="discord" />
      <p class="mb-3">
        {{ $t('profile.accounts.linkAdditional.discord.description') }}
      </p>

      <HtLinkButton
        color="primary"
        :icon-start="faDiscord"
        :href="route('login', { locale })"
        :external="true"
      >
        {{ $t('profile.accounts.linkAdditional.discord.authorize') }}
      </HtLinkButton>
    </section>

    <section>
      <ConnectedAccountsHeading service="crowdin" />
      <p class="mb-3">
        {{ $t('profile.accounts.linkAdditional.crowdin.description') }}
      </p>

      <HtLinkButton
        color="success"
        :href="route('oauthRedirect', { locale, provider: 'crowdin' })"
        :external="true"
      >
        {{ $t('profile.accounts.linkAdditional.crowdin.authorize') }}
      </HtLinkButton>
    </section>
  </HtCard>
</template>
