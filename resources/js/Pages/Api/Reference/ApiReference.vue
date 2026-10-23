<script setup lang="ts">
import ApiJsonExample from '@/Pages/Api/Reference/ApiJsonExample.vue';
import ApiOperationGroup from '@/Pages/Api/Reference/ApiOperationGroup.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { listOperations, OpenApiDocument } from '@/utils/openapi';
import { faBook, faFileCode } from '@fortawesome/free-solid-svg-icons';
import { computed } from 'vue';

const props = defineProps<{
  spec: OpenApiDocument | null;
  apiUrl: string;
}>();

const groups = computed(() => props.spec ? listOperations(props.spec) : []);
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('api.reference.heading') }}</h2>
    </template>

    <p class="mt-1 mb-3">
      {{ $t('api.reference.description') }}
    </p>

    <p class="mb-1">
      {{ $t('api.overview.baseUrl') }}
    </p>
    <HtCopyableText
      :data="apiUrl"
      class="mb-3"
    />
    <div class="mb-3">
      <HtLinkButton
        color="primary"
        :href="`${apiUrl}/`"
        :external="true"
        :target-blank="true"
        :icon-start="faBook"
        class="me-2"
      >
        {{ $t('api.overview.reference') }}
      </HtLinkButton>
      <HtLinkButton
        :href="`${apiUrl}/generated/api-docs.json`"
        :external="true"
        :target-blank="true"
        :icon-start="faFileCode"
      >
        {{ $t('api.overview.spec') }}
      </HtLinkButton>
    </div>

    <HtAlert
      v-if="!spec"
      type="warning"
      :closable="false"
    >
      <template #text>
        {{ $t('api.reference.unavailable') }}
      </template>
    </HtAlert>

    <template v-else>
      <section
        v-if="spec.components?.schemas?.Error"
        class="api-reference-group mb-3"
      >
        <h3>{{ $t('api.reference.errors') }}</h3>
        <p class="mb-2">
          {{ $t('api.reference.errorsDescription') }}
        </p>
        <ApiJsonExample
          :doc="spec"
          :schema="{ $ref: '#/components/schemas/Error' }"
        />
      </section>

      <ApiOperationGroup
        v-for="group of groups"
        :key="group.tag"
        :doc="spec"
        :tag="group.tag"
        :description="group.description"
        :operations="group.operations"
      />
    </template>
  </HtCard>
</template>
