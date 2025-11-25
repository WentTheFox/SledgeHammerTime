<script setup lang="ts">
import HtAvatar from '@/Reusable/HtAvatar.vue';
import { NormalizedCredits } from '@/utils/translation';
import { onMounted, ref, watch } from 'vue';

const props = defineProps<{
  credits: NormalizedCredits[];
}>();

const displayCredits = ref<NormalizedCredits[]>([]);

onMounted(() => {
  displayCredits.value = props.credits;
});

watch(() => props.credits, (newCredits) => {
  displayCredits.value = newCredits;
});
</script>

<template>
  <div
    v-if="displayCredits.length > 0"
    class="translation-credits"
  >
    <a
      v-for="(credit, i) in displayCredits"
      :key="i"
      class="translator-item"
      :href="credit.url"
    >
      <div class="translator-avatar">
        <HtAvatar :src="credit.avatarUrl" />
      </div>
      <span class="translator-name">{{ credit.displayName }}</span>
    </a>
  </div>
</template>
