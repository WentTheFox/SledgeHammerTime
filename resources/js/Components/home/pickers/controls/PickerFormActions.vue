<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';

const emit = defineEmits<{
  (e: 'close'): void;
}>();
</script>

<template>
  <HtButtonGroup class="mt-2">
    <HtButton
      color="primary"
      :justify-center="true"
      type="submit"
    >
      {{ $t('actions.save_and_close') }}
    </HtButton>
    <HtButton
      :justify-center="true"
      @click="emit('close')"
    >
      {{ $t('actions.close') }}
    </HtButton>
  </HtButtonGroup>
</template>
