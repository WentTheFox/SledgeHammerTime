<script setup lang="ts">
import { useExponentialBackoff } from '@/composables/useExponentialBackoff';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { router } from '@inertiajs/vue3';
import { inject, onMounted, onUnmounted } from 'vue';

export interface MaintenanceAlertProps {
  discordUrl?: string;
}

defineProps<MaintenanceAlertProps>();

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);

const safeReload = useExponentialBackoff('safe-reload', async () => {
  let routeUrl: string | undefined = undefined;
  let routeUrlError: unknown;
  try {
    routeUrl = String(route(route().current() as string, routeParams.value));
  } catch (e) {
    routeUrlError = e;
  }
  if (!routeUrl) {
    console.warn('Failed to get current route URL for automatic refresh', routeUrlError);
    return true;
  }

  const response = await fetch(routeUrl, { method: 'HEAD' });
  if (!response.ok) {
    return false;
  }

  router.get(routeUrl, undefined, { replace: true });
  return true;
});

onMounted(() => {
  safeReload.start();
});

onUnmounted(() => {
  safeReload.stop();
});
</script>

<template>
  <HtAlert
    type="warning"
    :closable="false"
  >
    <template #title>
      {{ $t('global.maintenanceMode.heading') }}
    </template>
    <template #text>
      <p>{{ $t('global.maintenanceMode.content.pleaseWait') }}</p>
      <p v-if="discordUrl">
        {{ $t('global.maintenanceMode.content.joinSupportServer') }}
      </p>
      <p v-else>
        {{ $t('global.maintenanceMode.content.contactDeveloper') }}
      </p>
    </template>
    <template
      v-if="discordUrl"
      #actions
    >
      <HtLinkButton
        :href="discordUrl"
        :icon-start="faDiscord"
        color="primary"
      >
        {{ $t('global.maintenanceMode.supportServerButton') }}
      </HtLinkButton>
    </template>
  </HtAlert>
</template>
