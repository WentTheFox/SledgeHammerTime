<script setup lang="ts">

import Layout from '@/Layouts/DefaultLayout.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { Head } from '@inertiajs/vue3';

defineProps<{
  discordUrl?: string;
}>();
</script>

<template>
  <Head :title="$t('global.maintenanceMode.heading')" />

  <Layout>
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
  </Layout>
</template>
