<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import { ButtonColors } from '@/utils/buttons';
import { faClipboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

defineProps<{
  color?: ButtonColors;
}>();
</script>

<template>
  <div class="mt-2">
    <HtButton :color="color">
      Default {{ color }} button
    </HtButton>
    &nbsp;
    <HtButton
      :color="color"
      :disabled="true"
    >
      Disabled {{ color }} button
    </HtButton>
    &nbsp;
    <HtButton
      :color="color"
      :loading="true"
    >
      Loading {{ color }} button
    </HtButton>
    &nbsp;
    <HtButton :color="color">
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    &nbsp;
    <HtButton
      :color="color"
      :disabled="true"
    >
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    &nbsp;
    <HtButton
      :color="color"
      :loading="true"
    >
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
  </div>
</template>
