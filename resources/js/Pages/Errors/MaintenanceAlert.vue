<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { useExponentialBackoff } from '@/composables/useExponentialBackoff';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import HtProgress from '@/Reusable/HtProgress.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { faRefresh } from '@fortawesome/free-solid-svg-icons';
import { router } from '@inertiajs/vue3';
import { inject, onMounted, onUnmounted, ref, watch } from 'vue';

export interface MaintenanceAlertProps {
  discordUrl?: string;
}

defineProps<MaintenanceAlertProps>();

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
const updating = ref(false);
const canUpdate = ref(false);
const resetCanUpdateTimeout = ref<ReturnType<typeof setTimeout> | null>(null);
const manualRefreshMinimumDelay = 1000;

const clearResetCanUpdateTimeout = () => {
  if (resetCanUpdateTimeout.value !== null) {
    clearTimeout(resetCanUpdateTimeout.value);
    resetCanUpdateTimeout.value = null;
  }
};

const handleSafeReload = async () => {
  updating.value = true;
  let routeUrl: string | undefined = undefined;
  let routeUrlError: unknown;
  try {
    const currentRouteName = route().current() as string;
    const currentRouteParams = currentRouteName === 'root' ? undefined : routeParams.value;
    routeUrl = String(route(currentRouteName, currentRouteParams));
  } catch (e) {
    routeUrlError = e;
  }
  if (!routeUrl) {
    console.warn('Failed to get current route URL for automatic refresh', routeUrlError);
    updating.value = false;
    return true;
  }

  const response = await fetch(routeUrl, { method: 'HEAD' });
  if (!response.ok) {
    updating.value = false;
    return false;
  }

  router.get(routeUrl, undefined, { replace: true });
  return true;
};

const safeReload = useExponentialBackoff('safe-reload', handleSafeReload);

const { progress, nextExecutionAt } = safeReload;

onMounted(() => {
  safeReload.start();
});

onUnmounted(() => {
  safeReload.stop();
  clearResetCanUpdateTimeout();
});

watch(updating, (newUpdating) => {
  if (newUpdating) {
    canUpdate.value = false;
    clearResetCanUpdateTimeout();
    return;
  }

  resetCanUpdateTimeout.value = setTimeout(() => {
    resetCanUpdateTimeout.value = null;
    canUpdate.value = !newUpdating;
  }, manualRefreshMinimumDelay);
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
      <p
        v-if="nextExecutionAt"
        class="mt-2"
      >
        <HtTranslate i18n-key="global.maintenanceMode.autoReload">
          <template #1>
            <TimestampPreview
              :ts="nextExecutionAt"
              :format="MessageTimestampFormat.RELATIVE"
            />
          </template>
        </HtTranslate>
        <HtProgress
          :bars="[{ progress: progress * 100, color: 'warning' }]"
          class="mt-3"
        />
      </p>
    </template>
    <template
      v-if="discordUrl"
      #actions
    >
      <HtButtonGroup :separated="true">
        <HtLinkButton
          :href="discordUrl"
          :icon-start="faDiscord"
          color="primary"
        >
          {{ $t('global.maintenanceMode.supportServerButton') }}
        </HtLinkButton>
        <HtButton
          :icon-start="faRefresh"
          :pressed="updating"
          :loading="updating"
          :disabled="!canUpdate"
          @click.prevent="handleSafeReload"
        >
          {{ $t('global.maintenanceMode.reloadButton') }}
        </HtButton>
      </HtButtonGroup>
    </template>
  </HtAlert>
</template>
