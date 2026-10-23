<script setup lang="ts">
import ApiOperationInfo from '@/Pages/Api/Reference/ApiOperationInfo.vue';
import { ListedOperation, OpenApiDocument } from '@/utils/openapi';
import { ref } from 'vue';

const props = withDefaults(defineProps<{
  doc: OpenApiDocument;
  tag: string;
  description: string | undefined;
  operations: ListedOperation[];
  /**
   * Whether opening an endpoint leaves the ones that are open as they are. Without it opening one closes the others, like the FAQ.
   */
  multiple?: boolean;
}>(), {
  multiple: false,
});

const openKeys = ref<Set<string>>(new Set());
const toggle = (key: string) => {
  const next = new Set(props.multiple ? openKeys.value : []);
  if (openKeys.value.has(key)) {
    next.delete(key);
  } else {
    next.add(key);
  }
  openKeys.value = next;
};
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
    <div class="api-operations">
      <ApiOperationInfo
        v-for="entry of operations"
        :key="`${entry.method} ${entry.path}`"
        :doc="doc"
        :method="entry.method"
        :path="entry.path"
        :operation="entry.operation"
        :open="openKeys.has(`${entry.method} ${entry.path}`)"
        @toggle="toggle(`${entry.method} ${entry.path}`)"
      />
    </div>
  </section>
</template>
