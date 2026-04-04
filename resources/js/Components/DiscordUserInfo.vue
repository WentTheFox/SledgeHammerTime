<script setup lang="ts">
import UserInfo from '@/Components/UserInfo.vue';
import { useExponentialBackoff } from '@/composables/useExponentialBackoff';
import { useRoute } from '@/composables/useRoute';
import { computed, ref, watch } from 'vue';

export interface DiscordUserInfoProps {
  id: string;
  name: string;
  avatarUrl: string;
  discriminator: string;
  staleAt?: string;
}

const props = defineProps<DiscordUserInfoProps>();

const route = useRoute();
const updatedInfo = ref<null | DiscordUserInfoProps>(null);

const currentInfo = computed((): DiscordUserInfoProps => updatedInfo.value ?? props);

const refreshUserInfo = useExponentialBackoff('refresh-user-info', async () => {
  if (!props.staleAt) return true;

  const localUserInfoRoute = route('app.localUserInfo', {
    provider: 'discord',
    id: props.id,
  });
  const response = await fetch(`${localUserInfoRoute}?stale_at=${encodeURIComponent(props.staleAt)}`);
  if (!response.ok) {
    return false;
  }

  updatedInfo.value = (await response.json()) as DiscordUserInfoProps;
  return true;
});

watch(() => props.staleAt, (staleAt) => {
  if (!staleAt) return;

  refreshUserInfo.start();
}, { immediate: true });
</script>

<template>
  <UserInfo
    class="discord-user-info"
    :name="currentInfo.name"
    :avatar-url="currentInfo.avatarUrl"
    service="Discord"
    :stale="!!currentInfo.staleAt"
  >
    <span class="user-name">{{ currentInfo.name }}</span>
  </UserInfo>
</template>
