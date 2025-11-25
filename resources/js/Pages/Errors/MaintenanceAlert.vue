<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { router } from '@inertiajs/vue3';
import { inject, onMounted, onUnmounted, ref } from 'vue';

export interface MaintenanceAlertProps {
  discordUrl?: string;
}

defineProps<MaintenanceAlertProps>();

const refreshTimeout = ref<ReturnType<typeof setTimeout> | null>(null);
const refreshCount = ref<number>(0);
const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);

const handleRefreshTimeout = () => {
  const nextRefreshIn = Math.pow(2, refreshCount.value++) * 500;
  console.info('Checking if the current page can be safely reloaded in %d ms', nextRefreshIn);
  refreshTimeout.value = setTimeout(() => {
    let routeUrl: string | undefined = undefined;
    let routeUrlError: unknown;
    try {
      routeUrl = String(route(route().current() as string, routeParams.value));
    } catch (e) {
      routeUrlError = e;
    }
    if (!routeUrl) {
      console.warn('Failed to get current route URL for automatic refresh', routeUrlError);
      clearRefreshTimeout();
      return;
    }

    fetch(routeUrl, { method: 'HEAD' }).then((response) => {
      if (!response.ok) {
        handleRefreshTimeout();
        return;
      }

      router.get(routeUrl, undefined, { replace: true });
    });
  }, nextRefreshIn);
};
const clearRefreshTimeout = () => {
  if (refreshTimeout.value !== null) {
    clearTimeout(refreshTimeout.value);
    refreshTimeout.value = null;
  }
};

onMounted(() => {
  handleRefreshTimeout();
});

onUnmounted(() => {
  clearRefreshTimeout();
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
