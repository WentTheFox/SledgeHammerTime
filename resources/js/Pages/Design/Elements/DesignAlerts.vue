<script setup lang="ts">
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';

defineProps<{
  placeholderText: string;
}>();
</script>

<template>
  <HtAlert type="info">
    <template #title>
      Info Alert
    </template>
    <template #text>
      {{ placeholderText }}
    </template>
  </HtAlert>
  <HtAlert type="warning">
    <template #title>
      Warning Alert
    </template>
    <template #text>
      {{ placeholderText }}
    </template>
  </HtAlert>
  <HtAlert type="unknown">
    <template #title>
      Unknown Alert
    </template>
    <template #text>
      {{ placeholderText }}
    </template>
  </HtAlert>
  <HtAlert
    type="unknown"
    :closable="false"
  >
    <template #title>
      Un-closable Alert
    </template>
  </HtAlert>
  <HtAlert
    type="unknown"
    :closable="false"
  >
    <template #text>
      Text-only
    </template>
  </HtAlert>
  <HtAlert
    type="info"
    :closable="false"
    :compact="true"
  >
    <template #title>
      Compact alert title
    </template>
    <template #text>
      Compact alert text
    </template>
    <template #actions>
      <HtButton>Compact alert actions</HtButton>
    </template>
  </HtAlert>
</template>
