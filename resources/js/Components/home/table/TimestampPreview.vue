<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { dateTimeLibraryInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { computed, getCurrentInstance, inject, ref, watch } from 'vue';

export interface TimestampPreviewProps {
  ts: DateTimeLibraryValue | undefined,
  unixTs?: number;
  format?: MessageTimestampFormat;
}

const props = defineProps<TimestampPreviewProps>();

const updateInterval = ref<ReturnType<typeof setInterval> | null>(null);
const instance = getCurrentInstance();

const dtl = inject(dateTimeLibraryInject);
const dateLibLocale = useDateLibraryLocale(dtl, instance);

const fromNow = computed(() => props.format === MessageTimestampFormat.RELATIVE);

watch(fromNow, (fromNowValue) => {
  if (updateInterval.value !== null) {
    clearInterval(updateInterval.value);
  }

  if (fromNowValue) {
    if (typeof window !== 'undefined') {
      updateInterval.value = setInterval(() => {
        instance?.proxy?.$forceUpdate();
      }, 1e3);
    }
  } else {
    updateInterval.value = null;
  }
}, { immediate: true });

const localTimestamp = computed(() => props.ts?.local());
</script>

<template>
  <template v-if="!format && unixTs">
    {{ unixTs }}
  </template>
  <time
    v-else-if="localTimestamp && dateLibLocale"
    :title="localTimestamp.setLocale(dateLibLocale).formatDiscordTimestamp(MessageTimestampFormat.LONG_FULL)"
    :datetime="localTimestamp.toISOString()"
  >
    <template v-if="fromNow">
      {{ localTimestamp.setLocale(dateLibLocale).fromNow() }}
    </template>
    <template v-else-if="format">
      {{ localTimestamp.setLocale(dateLibLocale).formatDiscordTimestamp(format) }}
    </template>
  </time>
</template>
