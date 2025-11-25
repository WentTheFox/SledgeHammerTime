<script setup lang="ts">
import InputSettings from '@/Components/sidebar/InputSettings.vue';
import TimeSync from '@/Components/sidebar/TimeSync.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import PickerContent from '@/Pages/Picker/PickerContent.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="" />

  <Layout>
    <template #sidebarWidgets>
      <InputSettings />
      <TimeSync />
    </template>
    <PickerContent />
  </Layout>
</template>
