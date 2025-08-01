<script setup lang="ts">
const props = defineProps<{
  responsive?: boolean,
  class?: string,
}>();
</script>

<template>
  <div :class="['table-wrap', props.class, { responsive }]">
    <table class="table">
      <slot />
    </table>
  </div>
</template>
