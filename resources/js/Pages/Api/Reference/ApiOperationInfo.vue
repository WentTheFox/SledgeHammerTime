<script setup lang="ts">
import ApiEndpoint from '@/Pages/Api/ApiEndpoint.vue';
import ApiJsonExample from '@/Pages/Api/Reference/ApiJsonExample.vue';
import HtAccordionItem from '@/Reusable/HtAccordionItem.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import { BadgeColor } from '@/utils/badges';
import { HttpMethod, jsonSchemaOf, OpenApiDocument, OpenApiOperation } from '@/utils/openapi';
import { computed } from 'vue';

const props = defineProps<{
  doc: OpenApiDocument;
  method: HttpMethod;
  path: string;
  operation: OpenApiOperation;
}>();

const requestSchema = computed(() => jsonSchemaOf(props.operation.requestBody));

const responses = computed(() => Object.entries(props.operation.responses ?? {}).map(([status, response]) => ({
  status,
  description: response.description,
  schema: jsonSchemaOf(response),
  color: (status.startsWith('2') ? 'green' : status.startsWith('4') ? 'yellow' : 'red') as BadgeColor,
})));

const needsKey = computed(() => (props.operation.security?.length ?? 0) > 0);
</script>

<template>
  <HtAccordionItem
    :id="`${method} ${path}`"
    class="api-operation"
  >
    <template #header>
      <ApiEndpoint
        :method="method"
        :path="path"
      />
      <span class="api-operation-summary">{{ operation.summary }}</span>
    </template>

    <p v-if="operation.description">
      {{ operation.description }}
    </p>

    <HtBadgeGroup>
      <HtBadge
        v-if="operation['x-required-scope']"
        color="purple"
        :prefix="$t('api.reference.permission')"
      >
        <code>{{ operation['x-required-scope'] }}</code>
      </HtBadge>
      <HtBadge
        v-else
        color="muted"
      >
        {{ needsKey ? $t('api.reference.anyKey') : $t('api.reference.noKey') }}
      </HtBadge>
    </HtBadgeGroup>

    <template v-if="requestSchema">
      <h5>{{ $t('api.reference.requestBody') }}</h5>
      <ApiJsonExample
        :doc="doc"
        :schema="requestSchema"
      />
    </template>

    <h5>{{ $t('api.reference.responses') }}</h5>
    <ul class="api-responses">
      <li
        v-for="response of responses"
        :key="response.status"
      >
        <HtBadge :color="response.color">
          {{ response.status }}
        </HtBadge>
        {{ response.description }}
        <ApiJsonExample
          v-if="response.status.startsWith('2') && response.schema"
          :doc="doc"
          :schema="response.schema"
        />
      </li>
    </ul>
  </HtAccordionItem>
</template>
