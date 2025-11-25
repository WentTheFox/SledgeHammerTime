<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { safeRoute } from '@/utils/safe-route';
import { faHammer } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { inject } from 'vue';

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
</script>

<template>
  <HtCard>
    <template #header>
      <h2>
        <FontAwesomeIcon
          :icon="faHammer"
          class="me-1"
        />
        {{ $t('botSettings.title') }}
      </h2>
    </template>

    <p class="mt-1 mb-3">
      {{ $t('botSettings.description') }}
    </p>

    <HtAlert
      :closable="false"
      type="info"
    >
      <template #text>
        <p class="mb-3 content-link-style">
          <HtTranslate i18n-key="botSettings.learnMore">
            <template #1="slotProps">
              <Link :href="safeRoute('botInfo', route, routeParams)">
                {{ slotProps.text }}
              </Link>
            </template>
          </HtTranslate>
        </p>
      </template>
    </HtAlert>
  </HtCard>
</template>
