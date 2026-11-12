import { describe, expect, it } from 'vitest';
import { getFailedRequestTraceId } from './request-failed-toast';

const traceId = '0af7651916cd43dd8448eb211c80319c';

describe('getFailedRequestTraceId', () => {
  it('returns the trace id of a server error', () => {
    expect(getFailedRequestTraceId(500, { 'x-trace-id': traceId })).toBe(traceId);
    expect(getFailedRequestTraceId(503, { 'x-trace-id': traceId })).toBe(traceId);
  });

  it('ignores client errors and successful responses', () => {
    expect(getFailedRequestTraceId(404, { 'x-trace-id': traceId })).toBeNull();
    expect(getFailedRequestTraceId(200, { 'x-trace-id': traceId })).toBeNull();
  });

  it('has nothing to show without a trace id, as for visitors who opted out', () => {
    expect(getFailedRequestTraceId(500, {})).toBeNull();
    expect(getFailedRequestTraceId(500, undefined)).toBeNull();
    expect(getFailedRequestTraceId(undefined, { 'x-trace-id': traceId })).toBeNull();
  });

  it('does not show anything that is not a trace id', () => {
    expect(getFailedRequestTraceId(500, { 'x-trace-id': '<script>' })).toBeNull();
  });
});
