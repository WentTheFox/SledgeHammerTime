import { formControlIdInject } from '@/injection-keys';
import { computed, ComputedRef, inject } from 'vue';

type UuidType = ReturnType<Crypto['randomUUID']>;
let mockUuidIncrement = 0;
const cryptoApi: (() => UuidType) | undefined = !import.meta.env.SSR && window?.crypto?.randomUUID
  ? (() => window.crypto.randomUUID())
  : (() => `uuid-fallback-${String(mockUuidIncrement++)}` as UuidType);

export const useFormControlId = <P extends {
  id?: string
}>(props?: P): ComputedRef<string | undefined> => {
  const injectedId = inject(formControlIdInject);
  const randomId = cryptoApi?.();

  return computed(() => props?.id ?? injectedId?.value ?? randomId);
};
