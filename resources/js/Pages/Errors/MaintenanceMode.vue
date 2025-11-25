<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import MaintenanceAlert, { MaintenanceAlertProps } from '@/Pages/Errors/MaintenanceAlert.vue';
import { Head } from '@inertiajs/vue3';

defineProps<MaintenanceAlertProps>();

</script>

<template>
  <Head :title="$t('global.maintenanceMode.heading')" />

  <Layout>
    <MaintenanceAlert :discord-url="discordUrl" />
  </Layout>
</template>
