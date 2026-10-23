<script setup lang="ts">
import { EXAMPLE_API_KEY } from '@/Pages/Api/example';
import CodeSample from '@/Pages/Api/Partials/CodeSample.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import { computed } from 'vue';

const props = defineProps<{
  apiUrl: string;
}>();

const mcpUrl = computed(() => `${props.apiUrl}/mcp`);

const claudeCodeCommand = computed(() => `claude mcp add --transport http hammertime ${mcpUrl.value} \\
  --header "Authorization: Bearer ${EXAMPLE_API_KEY}"`);

const genericConfig = computed(() => JSON.stringify({
  mcpServers: {
    hammertime: {
      type: 'http',
      url: mcpUrl.value,
      headers: { Authorization: `Bearer ${EXAMPLE_API_KEY}` },
    },
  },
}, null, 2));
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('api.mcp.heading') }}</h2>
    </template>

    <p class="mt-1 mb-3">
      {{ $t('api.mcp.description') }}
    </p>

    <p class="mb-1">
      {{ $t('api.mcp.url') }}
    </p>
    <HtCopyableText
      :data="mcpUrl"
      class="mb-3"
    />

    <HtAlert
      type="info"
      :closable="false"
      class="mb-3"
    >
      <template #text>
        {{ $t('api.mcp.placeholderKey') }}
      </template>
    </HtAlert>

    <p class="mb-2">
      {{ $t('api.mcp.claudeCode') }}
    </p>
    <CodeSample
      :code="claudeCodeCommand"
      language="shell"
    />

    <p class="mb-2">
      {{ $t('api.mcp.otherClients') }}
    </p>
    <CodeSample
      :code="genericConfig"
      language="json"
    />
  </HtCard>
</template>
