<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import HtCard from '@/Reusable/HtCard.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { safeRoute } from '@/utils/safe-route';
import { faUserGear } from '@fortawesome/free-solid-svg-icons';
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
          :icon="faUserGear"
          class="me-1"
        />
        {{ $t('profile.title') }}
      </h2>
    </template>
    <p class="content-link-style">
      <HtTranslate i18n-key="profile.intro">
        <template #1="slotProps">
          <Link :href="safeRoute('settings', route, routeParams)">
            {{ slotProps.text }}
          </Link>
        </template>
      </HtTranslate>
    </p>
  </HtCard>
</template>
