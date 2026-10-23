<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import HtCard from '@/Reusable/HtCard.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { MISSING_ROUTE_HREF, safeRoute } from '@/utils/safe-route';
import { computed, inject } from 'vue';

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
const loginRoute = computed(() => safeRoute('login', route, {
  routeParams: routeParams.value,
}));
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('profile.apiKeys.heading') }}</h2>
    </template>

    <p class="mt-1 mb-3">
      {{ $t('api.keys.loginPrompt') }}
    </p>
    <HtLinkButton
      v-if="loginRoute !== MISSING_ROUTE_HREF"
      color="primary"
      :href="loginRoute"
      :external="true"
      :target-blank="false"
    >
      {{ $t('actions.log_in') }}
    </HtLinkButton>
  </HtCard>
</template>
