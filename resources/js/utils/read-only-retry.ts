import type { HttpClient, HttpRequestConfig, HttpResponse } from '@inertiajs/core';
import { HttpCancelledError, HttpResponseError } from '@inertiajs/core';

export interface ReadOnlyRetryOptions {
  /** How many times a rejected request is sent again before the error reaches Inertia */
  maxRetries?: number;
  /** Upper bound for the wait taken from Retry-After, in seconds */
  maxDelaySeconds?: number;
  /** Extra random wait in milliseconds so waiting clients don't all come back at the same moment */
  jitterMs?: () => number;
  sleep?: (ms: number, signal?: AbortSignal) => Promise<void>;
}

const defaultSleep = (ms: number, signal?: AbortSignal) => new Promise<void>((resolve, reject) => {
  if (signal?.aborted) {
    reject(new HttpCancelledError('Request was cancelled'));
    return;
  }
  const timeout = setTimeout(() => {
    signal?.removeEventListener('abort', onAbort);
    resolve();
  }, ms);
  const onAbort = () => {
    clearTimeout(timeout);
    reject(new HttpCancelledError('Request was cancelled'));
  };
  signal?.addEventListener('abort', onAbort, { once: true });
});

/**
 * Seconds to wait before retrying, or null when the response is not the server's "read-only while deploying"
 * rejection: a 503 that carries Retry-After (BlockWritesInReadOnlyMode). The server refuses these requests before any
 * handler runs, so sending them again cannot apply a write twice.
 */
export const getReadOnlyRetryDelay = (error: unknown): number | null => {
  if (!(error instanceof HttpResponseError) || error.response.status !== 503) {
    return null;
  }
  const seconds = Number(error.response.headers['retry-after']);

  return Number.isFinite(seconds) && seconds >= 0 ? seconds : null;
};

/**
 * Wraps Inertia's HTTP client so requests rejected during a deploy's read-only window are retried transparently:
 * the visit (and the form's `processing` state) simply stays pending until the window is over.
 * Once the retries are used up the original error is thrown and Inertia shows it as usual.
 */
export const withReadOnlyRetry = (client: HttpClient, options: ReadOnlyRetryOptions = {}): HttpClient => {
  const {
    maxRetries = 3,
    maxDelaySeconds = 10,
    jitterMs = () => Math.random() * 1000,
    sleep = defaultSleep,
  } = options;

  return {
    async request(config: HttpRequestConfig): Promise<HttpResponse> {
      for (let attempt = 0; ; attempt++) {
        try {
          return await client.request(config);
        } catch (error) {
          const delaySeconds = getReadOnlyRetryDelay(error);
          if (delaySeconds === null || attempt >= maxRetries) {
            throw error;
          }
          await sleep(Math.min(Math.max(delaySeconds, 1), maxDelaySeconds) * 1000 + jitterMs(), config.signal);
        }
      }
    },
  };
};
