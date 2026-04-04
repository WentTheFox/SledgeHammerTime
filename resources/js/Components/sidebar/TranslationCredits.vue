<script setup lang="ts">
import HtAvatar from '@/Reusable/HtAvatar.vue';
import { NormalizedCredits } from '@/utils/crowdin';

defineProps<{
  credits: NormalizedCredits[];
}>();
</script>

<template>
  <div class="translation-credits">
    <a
      v-for="(credit, i) in credits"
      :key="i"
      class="translator-item"
      :href="credit.url"
    >
      <div class="translator-avatar">
        <HtAvatar :src="credit.avatarUrl ?? undefined" />
      </div>
      <span class="translator-name">{{ credit.displayName }}</span>
    </a>
  </div>
</template>
