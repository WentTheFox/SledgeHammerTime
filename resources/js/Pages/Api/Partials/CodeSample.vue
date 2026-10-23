<script setup lang="ts">
import HtCopyButton from '@/Reusable/HtCopyButton.vue';
import { CodeLanguage, highlightCode } from '@/utils/highlight-code';
import { computed } from 'vue';

const props = defineProps<{
  code: string;
  language: CodeLanguage;
}>();

const tokens = computed(() => highlightCode(props.code, props.language));
</script>

<template>
  <div class="api-code-sample">
    <pre><code><template
      v-for="(token, index) of tokens"
      :key="index"
    ><span
      v-if="token.type !== 'plain'"
      :class="`token-${token.type}`"
    >{{ token.text }}</span><template v-else>{{ token.text }}</template></template></code></pre>
    <HtCopyButton
      :text="code"
      class="api-code-sample-copy"
    />
  </div>
</template>
