<script setup lang="ts">
import ApiOperationInfo from '@/Pages/Api/Reference/ApiOperationInfo.vue';
import HtAccordion from '@/Reusable/HtAccordion.vue';
import { ListedOperation, OpenApiDocument } from '@/utils/openapi';

withDefaults(defineProps<{
  doc: OpenApiDocument;
  tag: string;
  description: string | undefined;
  operations: ListedOperation[];
  /**
   * Whether several endpoints can be open at once
   */
  multiple?: boolean;
}>(), {
  multiple: false,
});
</script>

<template>
  <section class="api-reference-group mb-3">
    <h3>{{ tag }}</h3>
    <p
      v-if="description"
      class="mb-2"
    >
      {{ description }}
    </p>
    <HtAccordion :multiple="multiple">
      <ApiOperationInfo
        v-for="entry of operations"
        :key="`${entry.method} ${entry.path}`"
        :doc="doc"
        :method="entry.method"
        :path="entry.path"
        :operation="entry.operation"
      />
    </HtAccordion>
  </section>
</template>
