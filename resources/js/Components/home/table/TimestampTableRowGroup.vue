<script setup lang="ts">

import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampTableRow from '@/Components/home/table/TimestampTableRow.vue';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { computed } from 'vue';

const props = defineProps<{
  currentTimestamp: DateTimeLibraryValue | undefined;
  unixTs: number | undefined;
  formats: MessageTimestampFormat[];
  hiddenFormats: Set<string>;
}>();

const displayFormats = computed(() => props.formats.filter(f => !props.hiddenFormats.has(f)));
const formatCount = computed(() => displayFormats.value.length);
</script>

<template>
  <TimestampTableRow
    v-for="(displayFormat, i) of displayFormats"
    :key="displayFormat"
    :icon="i === 0 ? (formatCount > 1 ? { cellHeight: formatCount} : true) : undefined"
    :ts="currentTimestamp"
    :unix-ts="unixTs"
    :format="displayFormat"
  >
    <template
      v-if="i === 0"
      #icon
    >
      <slot name="icon" />
    </template>
  </TimestampTableRow>
</template>
