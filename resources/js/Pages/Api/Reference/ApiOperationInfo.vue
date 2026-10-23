<script setup lang="ts">
import ApiJsonExample from '@/Pages/Api/Reference/ApiJsonExample.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtBadgeGroup from '@/Reusable/HtBadgeGroup.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import { BadgeColor } from '@/utils/badges';
import { HttpMethod, jsonSchemaOf, OpenApiDocument, OpenApiOperation } from '@/utils/openapi';
import { faCaretDown, faCaretRight } from '@fortawesome/free-solid-svg-icons';
import { computed } from 'vue';

const props = defineProps<{
  doc: OpenApiDocument;
  method: HttpMethod;
  path: string;
  operation: OpenApiOperation;
  open: boolean;
}>();

defineEmits<{
  (e: 'toggle'): void;
}>();

const methodColors: Record<HttpMethod, BadgeColor> = {
  get: 'green',
  post: 'blue',
  put: 'yellow',
  patch: 'yellow',
  delete: 'red',
};

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
  <div class="api-operation">
    <HtButton
      class="api-operation-toggle"
      :full-width="true"
      :allow-overflow="true"
      justify="start"
      :aria-expanded="open"
      :pressed="open"
      :icon-start="open ? faCaretDown : faCaretRight"
      @click="$emit('toggle')"
    >
      <HtBadge :color="methodColors[method]">
        {{ method.toUpperCase() }}
      </HtBadge>
      <span class="api-operation-path">{{ path }}</span>
      <span class="api-operation-summary">{{ operation.summary }}</span>
    </HtButton>
    <HtCollapsible
      :visible="open"
      class="mt-0"
    >
      <div class="api-operation-body">
        <p v-if="operation.description">
          {{ operation.description }}
        </p>

        <HtBadgeGroup>
          <HtBadge
            v-if="operation['x-required-scope']"
            color="purple"
            :prefix="$t('api.reference.permission')"
          >
            {{ $t(`profile.apiKeys.scopes.${operation['x-required-scope']}`) }}
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
      </div>
    </HtCollapsible>
  </div>
</template>
