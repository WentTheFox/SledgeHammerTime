import { formControlIdInject } from '@/injection-keys';
import { computed, ComputedRef, inject } from 'vue';

export const useFormControlId = <P extends {
  id: string | undefined
}>(props?: P): ComputedRef<string | undefined> => {
  const providedId = inject(formControlIdInject);
  const randomId = typeof window !== 'undefined' ? window.crypto.randomUUID() : undefined;

  return computed(() => props?.id ?? providedId?.value ?? randomId);
};
