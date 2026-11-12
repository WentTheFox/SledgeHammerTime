import { readonly, ref } from 'vue';

export interface RequestFailedToast {
  id: number;
  kind: 'requestFailed';
  /** The trace id of the failed request, for the user to quote when reporting it */
  traceId: string;
}

export type Toast = RequestFailedToast;

const TOAST_DURATION_MS = 20_000;

const toasts = ref<Toast[]>([]);
let nextId = 1;

export const dismissToast = (id: number): void => {
  toasts.value = toasts.value.filter((toast) => toast.id !== id);
};

export const showRequestFailedToast = (traceId: string): void => {
  // The same failure (a retried request, several requests of one page) is shown once
  if (toasts.value.some((toast) => toast.traceId === traceId)) {
    return;
  }
  const id = nextId++;
  toasts.value = [...toasts.value, { id, kind: 'requestFailed', traceId }];
  setTimeout(() => dismissToast(id), TOAST_DURATION_MS);
};

export const useToasts = () => readonly(toasts);
