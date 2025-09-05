<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import { faClipboard } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
</script>

<template>
  <div>
    <HtButton>Simple button</HtButton>
    &nbsp;
    <HtButton :disabled="true">
      Disabled default button
    </HtButton>
    &nbsp;
    <HtButton :loading="true">
      Loading default button
    </HtButton>
    &nbsp;
    <HtButton>
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    &nbsp;
    <HtButton :disabled="true">
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    &nbsp;
    <HtButton :loading="true">
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
  </div>
  <div>&nbsp;</div>
  <div>
    <HtButton color="primary">
      Primary button
    </HtButton>
    &nbsp;
    <HtButton
      color="primary"
      :disabled="true"
    >
      Disabled primary button
    </HtButton>
    &nbsp;
    <HtButton
      color="primary"
      :loading="true"
    >
      Loading primary button
    </HtButton>
    &nbsp;
    <HtButton color="primary">
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    &nbsp;
    <HtButton
      color="primary"
      :disabled="true"
    >
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
    &nbsp;
    <HtButton
      color="primary"
      :loading="true"
    >
      <FontAwesomeIcon :icon="faClipboard" />
    </HtButton>
  </div>
</template>
