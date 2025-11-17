<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import { getAppName } from '@/utils/app';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
const appName = getAppName();
const nonStick = computed(() => pageProps?.value.ziggy?.location === route('legal', routeParams.value));
</script>

<template>
  <div :class="['header', {'non-stick': nonStick}]">
    <div class="header-left">
      <slot name="left" />
    </div>
    <Link
      :href="route('root')"
      class="header-brand"
    >
      <ApplicationLogo :size="10" />
      <span class="header-brand-text">
        {{ appName }}
      </span>
    </Link>
    <div class="header-right">
      <slot name="right" />
    </div>
  </div>
</template>
