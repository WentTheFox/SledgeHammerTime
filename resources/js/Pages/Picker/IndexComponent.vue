<script setup lang="ts">
import FaqCard, { FaqEntry } from '@/Components/home/FaqCard.vue';
import InputSettings from '@/Components/sidebar/InputSettings.vue';
import TimeSync from '@/Components/sidebar/TimeSync.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import PickerContent from '@/Pages/Picker/PickerContent.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
  initialUtcDate?: string;
  initialUtcTime?: string;
  initialTimestamp?: number;
  faqEntries?: FaqEntry[];
}>();
</script>

<template>
  <Head title="" />

  <Layout>
    <template #sidebarWidgets>
      <InputSettings />
      <TimeSync />
    </template>
    <PickerContent
      :initial-date="initialUtcDate"
      :initial-time="initialUtcTime"
      :initial-timestamp="initialTimestamp"
    />

    <FaqCard
      v-if="faqEntries?.length"
      :faq-entries="faqEntries"
    />
  </Layout>
</template>
