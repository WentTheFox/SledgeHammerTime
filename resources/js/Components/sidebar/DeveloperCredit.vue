<script setup lang="ts">
import { pagePropsInject } from '@/injection-keys';
import HtAvatar from '@/Reusable/HtAvatar.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import { DEVELOPER_NAME } from '@/utils/app';
import { computed, inject } from 'vue';

const pageProps = inject(pagePropsInject);
const developerUrl = computed(() => pageProps?.value.developerUrl ?? '');
const developerAvatarUrl = computed(() => pageProps?.value.developerAvatarUrl ?? '');
</script>

<template>
  <HtExternalLink
    class="developer-credit"
    :href="developerUrl"
  >
    <div class="developer-avatar">
      <HtAvatar :src="developerAvatarUrl" />
    </div>
    <span class="developer-name">{{ DEVELOPER_NAME }}</span>
  </HtExternalLink>
</template>
