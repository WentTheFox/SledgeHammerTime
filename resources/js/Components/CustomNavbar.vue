<script setup lang="ts">
import { localSettingsInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtHeader from '@/Reusable/HtHeader.vue';
import { faBars } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const localSettingsValue = inject(localSettingsInject);
const isOpen = computed(() => Boolean(localSettingsValue?.sidebarOpen));
const isOnRight = computed(() => Boolean(localSettingsValue?.rawSidebarOnRight));
</script>

<template>
  <HtHeader :swap-slots="isOnRight">
    <template #left>
      <HtButton
        v-if="localSettingsValue"
        :disabled="isOpen"
        @click="localSettingsValue.setSidebarOpen(true)"
      >
        <FontAwesomeIcon :icon="faBars" />
      </HtButton>
    </template>
  </HtHeader>
</template>
