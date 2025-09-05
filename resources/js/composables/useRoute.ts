import { inject } from 'vue';
import type { route } from 'ziggy-js';

const routeFallback = ((value?: string) => {
  return typeof value === 'string' ? value : {};
}) as typeof route;

export const useRoute = (): typeof route => {
  return inject('route', routeFallback);
};
