<script setup lang="ts">
export interface CrowdinUserInfoProps {
  id: number;
  fullName?: string;
  username: string;
  avatarUrl: string;
}

defineProps<CrowdinUserInfoProps>();
</script>

<template>
  <figure class="crowdin-user-info">
    <img
      :alt="`Avatar of ${username}`"
      :src="avatarUrl"
      class="user-image"
    >
    <span class="full-name">{{ fullName || username }}</span>
    <template v-if="fullName">
      <span class="username">({{ username }})</span>
    </template>
  </figure>
</template>
