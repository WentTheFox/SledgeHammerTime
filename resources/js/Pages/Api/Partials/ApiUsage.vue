<script setup lang="ts">
import ApiEndpoint from '@/Pages/Api/ApiEndpoint.vue';
import { EXAMPLE_API_KEY } from '@/Pages/Api/example';
import CodeSample from '@/Pages/Api/Partials/CodeSample.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTable from '@/Reusable/HtTable.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { computed } from 'vue';

const props = defineProps<{
  apiUrl: string;
  scopes: string[];
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

    <h3 class="mb-2">
      {{ $t('api.permissions.heading') }}
    </h3>
    <p class="mb-2">
      {{ $t('api.permissions.description') }}
    </p>
    <p class="mb-2">
      <HtTranslate i18n-key="api.permissions.me">
        <template #1>
          <ApiEndpoint
            method="get"
            path="/me"
          />
        </template>
      </HtTranslate>
    </p>
    <HtTable
      :responsive="true"
      class="mb-3"
    >
      <thead>
        <tr>
          <th>{{ $t('api.permissions.columns.permission') }}</th>
          <th>{{ $t('api.permissions.columns.allows') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="scope of scopes"
          :key="scope"
        >
          <td>
            <HtBadge>
              <code>{{ scope }}</code>
            </HtBadge>
          </td>
          <td>{{ $t(`api.permissions.scopes.${scope}`) }}</td>
        </tr>
      </tbody>
    </HtTable>

    <p class="mb-2">
      {{ $t('api.usage.limits') }}
    </p>
    <p>
      {{ $t('api.usage.statistics') }}
    </p>
  </HtCard>
</template>
