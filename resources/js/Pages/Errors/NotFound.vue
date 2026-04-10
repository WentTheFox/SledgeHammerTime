<script setup lang="ts">
import Layout from '@/Layouts/DefaultLayout.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import NotFoundSuggestions from '@/Pages/Errors/NotFoundSuggestions.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
  discordUrl?: string;
}>();
</script>

<template>
  <Head :title="$t('global.notFound.heading')" />

  <Layout>
    <HtAlert
      type="warning"
      :closable="false"
    >
      <template #title>
        {{ $t('global.notFound.heading') }}
      </template>
      <template #text>
        {{ $t('global.notFound.content') }}
      </template>
    </HtAlert>

    <NotFoundSuggestions :discord-url="discordUrl" />
  </Layout>
</template>
