import { DeepReadonly, readonly, Ref, ref } from 'vue';

export interface ExponentialBackoffApi {
  start(): void;

  stop(): void;

  refreshCount: DeepReadonly<Ref<number>>;
}

export const useExponentialBackoff = (key: string, executeFn: () => (boolean | Promise<boolean>)): ExponentialBackoffApi => {
  const executionTimeout = ref<ReturnType<typeof setTimeout> | null>(null);
  const refreshCount = ref<number>(0);

  const handleExecutionTimeout = () => {
    const nextExecutionIn = Math.pow(2, refreshCount.value++) * 500;
    console.info('Exponential backoff %s next execution in %d ms', key, nextExecutionIn);
    executionTimeout.value = setTimeout(async () => {
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
  };

  return {
    start() {
      refreshCount.value = 0;
      handleExecutionTimeout();
    },
    stop() {
      clearExecutionTimeout();
    },
    refreshCount: readonly(refreshCount),
  };
};
