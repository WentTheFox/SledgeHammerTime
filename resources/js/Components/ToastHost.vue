<script setup lang="ts">
import { dismissToast, useToasts } from '@/composables/useToasts';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCopyableText from '@/Reusable/HtCopyableText.vue';

const toasts = useToasts();
</script>

<template>
  <div
    class="toast-host"
    aria-live="polite"
  >
    <HtAlert
      v-for="toast in toasts"
      :key="toast.id"
      type="error"
      compact
      @close="dismissToast(toast.id)"
    >
      <template #title>
        {{ $t('global.requestFailed.title') }}
      </template>
      <template #text>
        {{ $t('global.requestFailed.body') }}
        <HtCopyableText :data="toast.traceId" />
      </template>
    </HtAlert>
  </div>
</template>
