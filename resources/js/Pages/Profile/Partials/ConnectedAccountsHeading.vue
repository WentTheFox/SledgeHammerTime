<script setup lang="ts">
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed } from 'vue';

const props = defineProps<{
  service: 'discord' | 'crowdin';
}>();

const serviceIcon = computed(() => props.service === 'discord' ? faDiscord : null);
</script>

<template>
  <h3 class="mb-2">
    <FontAwesomeIcon
      v-if="serviceIcon"
      :icon="serviceIcon"
      class="me-1"
    />
    {{ $t(`profile.accounts.${service}`) }}
  </h3>
</template>
