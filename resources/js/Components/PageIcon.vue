<script setup lang="ts">
import { PageName, pageIcons } from '@/utils/pages';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

defineProps<{
  page: PageName;
  fixedWidth?: boolean;
}>();
</script>

<template>
  <FontAwesomeIcon
    :icon="pageIcons[page]"
    :fixed-width="fixedWidth"
  />
</template>
