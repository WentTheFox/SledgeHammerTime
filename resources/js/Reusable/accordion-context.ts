import type { ComputedRef, InjectionKey } from 'vue';

export interface AccordionContext {
  isOpen: (id: string) => boolean;
  toggle: (id: string) => void;
  openIds: ComputedRef<string[]>;
}

export const accordionInject = Symbol('accordion') as InjectionKey<AccordionContext>;
