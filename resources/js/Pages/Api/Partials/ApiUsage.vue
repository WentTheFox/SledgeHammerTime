<script setup lang="ts">
import { EXAMPLE_API_KEY } from '@/Pages/Api/example';
import CodeSample from '@/Pages/Api/Partials/CodeSample.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { computed } from 'vue';

const props = defineProps<{
  apiUrl: string;
}>();

const example = computed(() => `curl ${props.apiUrl}/at \\
  -H "Authorization: Bearer ${EXAMPLE_API_KEY}" \\
  -H "Content-Type: application/json" \\
  -d '{"hour": 18, "minute": 30}'`);
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('api.usage.heading') }}</h2>
    </template>

    <p class="mt-1 mb-2">
      {{ $t('api.usage.authentication') }}
    </p>
    <p class="mb-2">
      {{ $t('api.usage.example') }}
    </p>
    <CodeSample
      :code="example"
      language="shell"
    />

    <p class="mb-2">
      {{ $t('api.usage.limits') }}
    </p>
    <p>
      {{ $t('api.usage.statistics') }}
    </p>
  </HtCard>
</template>
