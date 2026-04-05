import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { dateTimeLibraryInject } from '@/injection-keys';
import { DeepReadonly, inject, readonly, Ref, ref } from 'vue';

export interface ExponentialBackoffApi {
  start(): void;

  stop(): void;

  refreshCount: DeepReadonly<Ref<number>>;
  progress: DeepReadonly<Ref<number>>;
  nextExecutionAt: DeepReadonly<Ref<DateTimeLibraryValue | null>>;
}

export const useExponentialBackoff = (key: string, executeFn: () => (boolean | Promise<boolean>)): ExponentialBackoffApi => {
  const executionTimeout = ref<ReturnType<typeof setTimeout> | null>(null);
  const refreshCount = ref<number>(0);
  const progress = ref<number>(0);
  let progressInterval: ReturnType<typeof setInterval> | null = null;
  const dtl = inject(dateTimeLibraryInject);
  const timerStart= ref<DateTimeLibraryValue | null>(null);
  const nextExecutionAt = ref<DateTimeLibraryValue | null>(null);

  const clearProgressInterval = () => {
    if (progressInterval !== null) {
      clearInterval(progressInterval);
      progressInterval = null;
    }
  };

  const handleExecutionTimeout = () => {
    const nextExecutionIn = Math.pow(2, refreshCount.value++) * 500;
    console.info('Exponential backoff %s next execution in %d ms', key, nextExecutionIn);

    if (dtl) {
      timerStart.value = dtl.value.now();
      nextExecutionAt.value = timerStart.value.addMilliseconds(nextExecutionIn);
      progress.value = 0;

      clearProgressInterval();
      progressInterval = setInterval(() => {
        if (nextExecutionAt.value == null || timerStart.value === null) {
          progress.value = 0;
          return;
        }
        progress.value = Math.min((dtl.value.now().getUnixMilliseconds() - timerStart.value?.getUnixMilliseconds()) / (nextExecutionAt.value.getUnixMilliseconds() - timerStart.value.getUnixMilliseconds()), 1);
      }, 200);
    }

    executionTimeout.value = setTimeout(async () => {
      clearProgressInterval();
      progress.value = 1;
      const result = await executeFn();
      if (result === true) {
        clearExecutionTimeout();
        return;
      }

      handleExecutionTimeout();
    }, nextExecutionIn);
  };
  const clearExecutionTimeout = () => {
    if (executionTimeout.value !== null) {
      clearTimeout(executionTimeout.value);
      executionTimeout.value = null;
    }
    nextExecutionAt.value = null;
  };

  return {
    start() {
      refreshCount.value = 0;
      handleExecutionTimeout();
    },
    stop() {
      clearProgressInterval();
      clearExecutionTimeout();
    },
    refreshCount: readonly(refreshCount),
    progress: readonly(progress),
    nextExecutionAt: readonly(nextExecutionAt),
  };
};
