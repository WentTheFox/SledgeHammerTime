<script setup lang="ts">
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { dateTimeLibraryInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { ComboboxOption } from '@/utils/combobox';
import { getCurrentInstance, inject, onMounted, onUnmounted, ref, watch } from 'vue';

const props = defineProps<{
  option: ComboboxOption;
}>();

const localTime = ref<string>('');
const localTimeCalculatorInterval = ref<null | ReturnType<typeof setInterval>>(null);
const dtl = inject(dateTimeLibraryInject);
const instance = getCurrentInstance();
const dateLibLocale = useDateLibraryLocale(dtl, instance);

const updateLocalTime = () => {
  if (!dtl || !dateLibLocale.value) {
    localTime.value = '';
    return;
  }
  const zonedNowValue = dtl.value
    .nowInZone(props.option.value)
    .setLocale(dateLibLocale.value);
  localTime.value = zonedNowValue.formatDiscordTimestamp(MessageTimestampFormat.SHORT_TIME);
};

onMounted(() => {
  updateLocalTime();
  localTimeCalculatorInterval.value = setInterval(updateLocalTime, 1e3);
});
onUnmounted(() => {
  if (localTimeCalculatorInterval.value !== null) {
    clearInterval(localTimeCalculatorInterval.value);
  }
});

watch([dtl, dateLibLocale], () => {
  updateLocalTime();
});
</script>

<template>
  <span class="local-time">{{ localTime }}</span>
</template>

<style lang="scss" scoped>
.local-time {
  animation: local-time-fade-in .2s ease-out forwards;

  @keyframes local-time-fade-in {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
}
</style>
