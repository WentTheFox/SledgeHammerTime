import type { HttpClient, HttpRequestConfig, HttpResponse } from '@inertiajs/core';
import { HttpResponseError } from '@inertiajs/core';
import { showRequestFailedToast } from '@/composables/useToasts';

const TRACE_ID_HEADER = 'x-trace-id';

const isTraceId = (value: unknown): value is string => typeof value === 'string' && /^[0-9a-f]{32}$/.test(value);

/**
 * The trace id the server sent with a failed (5xx) response, or null for anything else. There is a trace id only while
 * tracing is on for the visitor, so nothing is shown to visitors who opted out.
 */
export const getFailedRequestTraceId = (status: number | undefined, headers: Record<string, unknown> | undefined): string | null => {
  if (status === undefined || status < 500) {
    return null;
  }
  const traceId = headers?.[TRACE_ID_HEADER];

  return isTraceId(traceId) ? traceId : null;
};

/** Shows a toast with the trace id when Inertia's request failed on the server */
export const withRequestFailedToast = (client: HttpClient): HttpClient => ({
  async request(config: HttpRequestConfig): Promise<HttpResponse> {
    try {
      return await client.request(config);
    } catch (error) {
      if (error instanceof HttpResponseError) {
        const traceId = getFailedRequestTraceId(error.response.status, error.response.headers);
        if (traceId) {
          showRequestFailedToast(traceId);
        }
      }
      throw error;
    }
  },
});
