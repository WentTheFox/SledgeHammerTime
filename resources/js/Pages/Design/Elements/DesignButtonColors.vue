<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import { ButtonColors } from '@/utils/buttons';
import { faClipboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

defineProps<{
  color?: ButtonColors;
}>();
</script>

<template>
  <HtButtonGroup
    :separated="true"
    class="mt-2"
  >
    <HtButton :color="color">
      Default {{ color }} button
    </HtButton>
    <HtButton
      :color="color"
      :disabled="true"
    >
      Disabled {{ color }} button
    </HtButton>
    <HtButton
      :color="color"
      :loading="true"
    >
      Loading {{ color }} button
    </HtButton>
    <HtButton :color="color">
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    <HtButton
      :color="color"
      :disabled="true"
    >
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    <HtButton
      :color="color"
      :loading="true"
    >
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
  </HtButtonGroup>
</template>
