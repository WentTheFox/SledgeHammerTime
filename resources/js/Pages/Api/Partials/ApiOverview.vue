<script setup lang="ts">
import PageIcon from '@/Components/PageIcon.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { PageName } from '@/utils/pages';
</script>

<template>
  <HtCard>
    <template #header>
      <h1>
        <PageIcon
          :page="PageName.Api"
          class="me-1"
        />
        {{ $t('api.heading') }}
      </h1>
    </template>

    <p class="mt-1">
      {{ $t('api.description') }}
    </p>
  </HtCard>
</template>
