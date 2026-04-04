import { isJsUnavailableInject } from '@/injection-keys';
import { computed, inject, readonly, ref } from 'vue';

export const useIsJsUnavailable = () => {
  const isJsUnavailable = inject(isJsUnavailableInject, readonly(ref(true)));

  return computed(() => (isJsUnavailable?.value ?? true));
}
