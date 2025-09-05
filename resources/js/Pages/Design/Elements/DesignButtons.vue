<script setup lang="ts">
import DesignButtonColors from '@/Pages/Design/Elements/DesignButtonColors.vue';
import { ButtonColors } from '@/utils/buttons';

const buttonColors: Record<ButtonColors, true> = {
  'primary': true,
  'success': true,
  'danger': true,
  'warning': true,
  'light': true,
  'dark': true,
};
</script>

<template>
  <p class="mb-3">
    Buttons
  </p>
  <DesignButtonColors />
  <DesignButtonColors
    v-for="(_, key) in buttonColors"
    :key="key"
    :color="key"
  />
</template>
