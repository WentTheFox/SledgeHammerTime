import { formControlIdInject } from '@/injection-keys';
import { computed, ComputedRef, inject } from 'vue';

export const useFormControlId = <P extends {
  id?: string
}>(props?: P): ComputedRef<string | undefined> => {
  const injectedId = inject(formControlIdInject);
  const randomId = !import.meta.env.SSR ? window.crypto.randomUUID() : undefined;

  return computed(() => props?.id ?? injectedId?.value ?? randomId);
};
