import { tryOnScopeDispose } from '@vueuse/core';
import { config } from '@inertiajs/vue3';

export interface RecentlySuccessfulForm {
  recentlySuccessful: boolean;
}

/**
 * Inertia clears a form's `recentlySuccessful` flag itself, but only after a request it sent. For a form that is saved
 * some other way (a cookie, local storage), call the returned function with the form once the save is done: the flag
 * is set, and cleared again after the duration Inertia is configured with for its own forms
 * (`form.recentlySuccessfulDuration`) or the one given. Calling it again for the same form starts the period over, forms
 * do not affect each other, and pending clears are cancelled when the component (or effect scope) is disposed.
 */
export const useRecentlySuccessful = () => {
  const timeouts = new Map<RecentlySuccessfulForm, ReturnType<typeof setTimeout>>();

  tryOnScopeDispose(() => {
    timeouts.forEach((timeout) => clearTimeout(timeout));
    timeouts.clear();
  });

  return (form: RecentlySuccessfulForm, durationMs?: number): void => {
    clearTimeout(timeouts.get(form));
    form.recentlySuccessful = true;
    timeouts.set(form, setTimeout(() => {
      form.recentlySuccessful = false;
      timeouts.delete(form);
    }, durationMs ?? config.get('form.recentlySuccessfulDuration')));
  };
};
