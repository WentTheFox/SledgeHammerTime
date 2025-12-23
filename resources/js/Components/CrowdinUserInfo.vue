<script setup lang="ts">
import UserInfo from '@/Components/UserInfo.vue';
import { computed } from 'vue';

export interface CrowdinUserInfoProps {
  id: number;
  fullName?: string;
  username: string;
  avatarUrl: string;
}

const props = defineProps<CrowdinUserInfoProps>();

const displayName = computed(() => props.fullName || props.username);
</script>

<template>
  <UserInfo
    class="crowdin-user-info"
    :name="displayName"
    service="Crowdin"
    :avatar-url="avatarUrl"
    :stale="false"
  >
    <span class="full-name">{{ displayName }}</span>
    <template v-if="fullName">
      <span class="username">({{ username }})</span>
    </template>
  </UserInfo>
</template>
