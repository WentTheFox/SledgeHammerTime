<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Status" />

  <Layout :language-selector="false">
    <HtAlert
      type="info"
      :closable="false"
    >
      <template #title>
        <h2>Congratulations!</h2>
      </template>
      <template #text>
        <p>
          You've stumbled upon the status page used for automated uptime monitoring.
          If this page loads, that means the rest of the application is most likely also working
          properly.
        </p>
      </template>
    </HtAlert>
  </Layout>
</template>
