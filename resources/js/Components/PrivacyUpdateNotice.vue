<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { localSettingsInject, pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { PRIVACY_UPDATE_DATE_ISO } from '@/utils/app';
import { LegalSectionIds, shouldShowPrivacyNotice } from '@/utils/legal';
import { safeRoute } from '@/utils/safe-route';
import { Link } from '@inertiajs/vue3';
import { computed, inject, onMounted, ref } from 'vue';

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
const settings = inject(localSettingsInject);
const mounted = ref(false);

/**
 * Shown on every page until it is dismissed. The dismissal time is stored, so a later policy update (a newer
 * PRIVACY_UPDATE_DATE_ISO) makes it appear again for everyone who dismissed it before that.
 */
const visible = computed(() => {
  // Rendered only after mounting, as the stored dismissal is not available during SSR (it would flash or mismatch)
  if (!mounted.value) {
    return false;
  }

  return shouldShowPrivacyNotice(settings?.privacyNoticeDismissedAt ?? null, PRIVACY_UPDATE_DATE_ISO);
});

const dismiss = () => settings?.setPrivacyNoticeDismissedAt(new Date().toISOString());

onMounted(() => {
  mounted.value = true;
});
</script>

<template>
  <HtAlert
    v-if="visible"
    type="info"
    compact-inline
    class="mb-3"
    @close="dismiss"
  >
    <template #title>
      {{ $t('global.privacyUpdated.title') }}
    </template>
    <template #text>
      <HtTranslate i18n-key="global.privacyUpdated.body">
        <template #1="slotProps">
          <Link :href="`${safeRoute('legal', route, { routeParams })}#${LegalSectionIds.OPT_OUT}`">
            {{ slotProps.text }}
          </Link>
        </template>
      </HtTranslate>
    </template>
  </HtAlert>
</template>
