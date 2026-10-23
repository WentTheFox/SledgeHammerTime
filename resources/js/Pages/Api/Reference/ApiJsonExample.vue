<script setup lang="ts">
import HtCopyButton from '@/Reusable/HtCopyButton.vue';
import { highlightCode } from '@/utils/highlight-code';
import { JsonAnnotation, JsonRow, OpenApiDocument, OpenApiSchema, buildJsonRows, rowsToJson } from '@/utils/openapi';
import { computed } from 'vue';

const props = defineProps<{
  doc: OpenApiDocument;
  schema: OpenApiSchema | undefined;
}>();

const rows = computed<JsonRow[]>(() => buildJsonRows(props.schema, props.doc));
const json = computed(() => rowsToJson(rows.value));

// Every annotation is kept to one line so the lines of the JSON stay one line each, the whole text is in the tooltip
const titleOf = (annotation: JsonAnnotation): string => [
  annotation.type,
  annotation.optional ? 'optional' : null,
  annotation.constraints.length > 0 ? annotation.constraints.join(', ') : null,
  annotation.description,
  annotation.choices ? `(${annotation.choices.join(', ')})` : null,
].filter(Boolean).join(' · ');
</script>

<template>
  <div class="api-json-example">
    <div class="api-json">
      <div
        v-for="(row, index) of rows"
        :key="index"
        class="api-json-row"
      >
        <code
          class="api-json-line"
          :style="{ paddingInlineStart: `${row.depth * 2}ch` }"
        ><template
          v-for="(token, tokenIndex) of highlightCode(row.line, 'json')"
          :key="tokenIndex"
        ><span
          v-if="token.type !== 'plain'"
          :class="`token-${token.type}`"
        >{{ token.text }}</span><template v-else>{{ token.text }}</template></template></code>
        <span
          v-if="row.annotation"
          class="api-json-annotation"
          :title="titleOf(row.annotation)"
        >
          <span class="api-json-type">{{ row.annotation.type }}</span>
          <span
            v-if="row.annotation.optional"
            class="api-json-optional"
          >{{ $t('api.reference.optional') }}</span>
          <span
            v-if="row.annotation.constraints.length > 0"
            class="api-json-choices"
          >{{ row.annotation.constraints.join(', ') }}</span>
          <template v-if="row.annotation.description">
            {{ row.annotation.description }}
          </template>
          <span
            v-if="row.annotation.choices"
            class="api-json-choices"
          >({{ row.annotation.choices.join(', ') }})</span>
        </span>
        <span
          v-else
          class="api-json-annotation"
        />
      </div>
    </div>
    <HtCopyButton
      :text="json"
      class="api-json-copy"
    />
  </div>
</template>
