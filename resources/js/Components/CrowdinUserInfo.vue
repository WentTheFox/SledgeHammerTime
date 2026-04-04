<script setup lang="ts">
import UserInfo from '@/Components/UserInfo.vue';
import { useExponentialBackoff } from '@/composables/useExponentialBackoff';
import { useRoute } from '@/composables/useRoute';
import { computed, ref, watch } from 'vue';

export interface CreditOverrideValues {
  displayName: string | null;
  avatarProvider: string | null;
  avatarId: string | null;
  url: string | null;
  hide: boolean;
}

export interface ProposalValues extends Omit<CreditOverrideValues, 'hide'> {
  rejectedAt: string | null;
}

export interface CrowdinTranslators {
  id: string;
  languageCode: string;
  translated: number;
  approved: number;
  voted: number;
  override: CreditOverrideValues | null;
  proposal: ProposalValues | null;
}

export interface CrowdinUserInfoProps {
  id: number;
  fullName?: string;
  username: string;
  avatarUrl: string;
  url: string;
  staleAt?: string;
  translators: CrowdinTranslators[];
}

const props = defineProps<CrowdinUserInfoProps>();

const route = useRoute();
const updatedInfo = ref<null | CrowdinUserInfoProps>(null);

const currentInfo = computed((): CrowdinUserInfoProps => updatedInfo.value ?? props);
const displayName = computed(() => currentInfo.value.fullName || currentInfo.value.username);

const refreshUserInfo = useExponentialBackoff('refresh-user-info', async () => {
  if (!props.staleAt) return true;

  const localUserInfoRoute = route('app.localUserInfo', {
    provider: 'crowdin',
    id: props.id,
  });
  const response = await fetch(`${localUserInfoRoute}?stale_at=${encodeURIComponent(props.staleAt)}`);
  if (!response.ok) {
    return false;
  }

  updatedInfo.value = (await response.json()) as CrowdinUserInfoProps;
  return true;
});

watch(() => props.staleAt, (staleAt) => {
  if (!staleAt) return;

  refreshUserInfo.start();
}, { immediate: true });
</script>

<template>
  <UserInfo
    class="crowdin-user-info"
    :name="displayName"
    service="Crowdin"
    :avatar-url="currentInfo.avatarUrl"
    :stale="!!currentInfo.staleAt"
  >
    <span class="full-name">{{ displayName }}</span>
    <template v-if="currentInfo.fullName">
      <span class="username">({{ currentInfo.username }})</span>
    </template>
  </UserInfo>
</template>
