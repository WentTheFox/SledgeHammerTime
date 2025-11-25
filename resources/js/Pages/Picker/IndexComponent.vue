<script setup lang="ts">
import TimeSync from '@/Components/sidebar/TimeSync.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import PickerContent from '@/Pages/Picker/PickerContent.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="" />

  <Layout>
    <template #sidebarWidgets>
      <TimeSync />
    </template>
    <PickerContent />
  </Layout>
</template>
