<script setup lang="ts">
import HtCode from '@/Reusable/HtCode.vue';
import HtCopyButton from '@/Reusable/HtCopyButton.vue';
import { ref } from 'vue';
import { Tippy } from 'vue-tippy';

withDefaults(defineProps<{
  data: string | number | undefined;
  monospace?: boolean
}>(), {
  monospace: true,
});

const copied = ref<boolean>(false);

const setCopied = (newValue: boolean) => {
  copied.value = newValue;
};
</script>

<template>
  <div
    v-if="data"
    class="copyable-text"
  >
    <Tippy :hide-on-click="false">
      <HtCopyButton
        class="copyable-text-button"
        :text="data"
        @copied="setCopied($event)"
      />
      <template #content>
        {{ copied ? $t('global.copiedToClipboard') : $t('global.copyToClipboard') }}
      </template>
    </Tippy>
    <HtCode
      :base-font="!monospace"
      class="copyable-text-data"
    >
      {{ data }}
    </HtCode>
  </div>
</template>
