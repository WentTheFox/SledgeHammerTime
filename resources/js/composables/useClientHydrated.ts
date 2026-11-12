import { readonly, ref } from 'vue';

/**
 * Whether the browser has taken over from the server rendered HTML. Server rendered pages are cached and shared between visitors, so
 * anything that depends on the visitor's URL (query parameters), clock or settings must not be part of the server render nor of the
 * first client render (they have to be identical to hydrate cleanly); render it once this turns true instead.
 *
 * Module level state is fine here: it is only ever set by the client bundle, so the SSR process never leaves `false`.
 */
const hydrated = ref(false);

export const clientHydrated = readonly(hydrated);

export const markClientHydrated = () => {
  hydrated.value = true;
};
