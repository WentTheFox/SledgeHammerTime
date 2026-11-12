<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { dateTimeLibraryInject, localSettingsInject } from '@/injection-keys';
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
const dateLibLocale = useDateLibraryLocale(dtl);
const settings = inject(localSettingsInject);

const fromNow = computed(() => props.format === MessageTimestampFormat.RELATIVE);

watch(fromNow, (fromNowValue) => {
  if (updateInterval.value !== null) {
    clearInterval(updateInterval.value);
  }

  if (fromNowValue) {
    if (!import.meta.env.SSR) {
      updateInterval.value = setInterval(() => {
        instance?.proxy?.$forceUpdate();
      }, 1e3);
    }
  } else {
    updateInterval.value = null;
  }
}, { immediate: true });

const localTimestamp = computed(() => props.ts?.local());

// Not a computed: the relative text must be re-evaluated on every forced render
const getDisplayText = () => {
  if (!localTimestamp.value || !dateLibLocale.value) return '';
  const localized = localTimestamp.value.setLocale(dateLibLocale.value);
  if (fromNow.value) return localized.fromNow();
  return props.format ? localized.formatDiscordTimestamp(props.format, settings?.hourCycle) : '';
};
</script>

<template>
  <template v-if="!format && unixTs">
    {{ unixTs }}
  </template>
  <time
    v-else-if="localTimestamp && dateLibLocale"
    :title="localTimestamp.setLocale(dateLibLocale).formatDiscordTimestamp(MessageTimestampFormat.LONG_FULL, settings?.hourCycle)"
    :datetime="localTimestamp.toISOString()"
    :data-allow-mismatch="fromNow ? 'text' : undefined"
  >{{ getDisplayText() }}</time>
</template>
