<script setup lang="ts">
import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { CalendarContext, DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { computed } from 'vue';

const props = defineProps<{
  dateTime: DateTimeLibraryValue;
  dateLibLocale: DateTimeLibraryLocale;
  currentContext: CalendarContext;
}>();

const longContext = computed(() => props.dateTime.setLocale(props.dateLibLocale).formatCalendarContext(props.currentContext, false));
const shortContext = computed(() => props.dateTime.setLocale(props.dateLibLocale).formatCalendarContext(props.currentContext, false));
const renderShortContext = computed(() => shortContext.value.length > 0);
</script>

<template>
  <span class="long-context">
    <HtTranslate
      v-if="longContext.length > 1"
      i18n-key="timestampPicker.picker.button.contextRange"
    >
      <template #0>{{ longContext[0] }}</template>
      <template #2>{{ longContext[1] }}</template>
    </HtTranslate>
    <template v-else>{{ longContext[0] }}</template>
  </span>
  <span
    v-if="renderShortContext"
    class="short-context"
  >
    <HtTranslate
      v-if="shortContext.length > 1"
      i18n-key="timestampPicker.picker.button.contextRange"
    >
      <template #0>{{ shortContext[0] }}</template>
      <template #2>{{ shortContext[1] }}</template>
    </HtTranslate>
    <template v-else>{{ shortContext[0] }}</template>
  </span>
</template>
