import { formControlFullWidthInject } from '@/injection-keys';
import { computed, ComputedRef, inject } from 'vue';

export const useFormControlFullWidth = <P extends {
  fullWidth?: boolean
}>(props?: P): ComputedRef<boolean> => {
  const injectedFullWidth = inject(formControlFullWidthInject);

  return computed(() => props?.fullWidth ?? injectedFullWidth?.value ?? false);
};
