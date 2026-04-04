<script setup lang="ts">
import { avatarUrlMapInject } from '@/injection-keys';
import HtAvatar from '@/Reusable/HtAvatar.vue';
import { ComboboxOption } from '@/utils/combobox';
import { inject } from 'vue';

defineProps<{ option: ComboboxOption }>();

const avatarUrlMap = inject(avatarUrlMapInject);
</script>

<template>
  <HtAvatar
    v-if="avatarUrlMap?.[option.value]"
    :src="avatarUrlMap[option.value]"
    :size="32"
  />
</template>
