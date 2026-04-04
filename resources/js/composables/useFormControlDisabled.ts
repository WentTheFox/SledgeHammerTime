import { formControlDisabledInject } from '@/injection-keys';
import { computed, ComputedRef, inject } from 'vue';

export const useFormControlDisabled = <P extends {
  disabled?: boolean
}>(props?: P): ComputedRef<boolean> => {
  const injectedDisabled = inject(formControlDisabledInject);

  return computed(() => props?.disabled ?? injectedDisabled?.value ?? false);
};
