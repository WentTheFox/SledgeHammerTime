<script setup lang="ts">
import { ComboboxAddonComponentProps } from '@/utils/combobox';

defineProps<ComboboxAddonComponentProps>();
</script>

<template>
  <span class="language-code">
    {{ option.value }}
  </span>
</template>

<style scoped lang="scss">
@use "../../../../css/design";

.language-code {
  @include design.monospace-font;
}
</style>
