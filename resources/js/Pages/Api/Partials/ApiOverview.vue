<script setup lang="ts">
import HtCard from '@/Reusable/HtCard.vue';
</script>

<template>
  <HtCard>
    <template #header>
      <h1>{{ $t('api.heading') }}</h1>
    </template>

    <p class="mt-1">
      {{ $t('api.description') }}
    </p>
  </HtCard>
</template>
