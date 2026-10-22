import type { HttpClient, HttpRequestConfig, HttpResponse } from '@inertiajs/core';
import { HttpCancelledError, HttpNetworkError, HttpResponseError } from '@inertiajs/core';
import { describe, expect, it, vi } from 'vitest';
import { getReadOnlyRetryDelay, withReadOnlyRetry } from './read-only-retry';

const config: HttpRequestConfig = { method: 'put', url: '/settings/1', data: { a: 1 } };
const ok: HttpResponse = { status: 200, data: '{}', headers: {} };
const rejection = (status: number, headers: Record<string, string> = { 'retry-after': '5' }) =>
  new HttpResponseError(`Request failed with status ${status}`, { status, data: '', headers }, config.url);

const clientFrom = (...results: (HttpResponse | Error)[]) => {
  const request = vi.fn<HttpClient['request']>();
  results.forEach(result => request.mockImplementationOnce(() => result instanceof Error ? Promise.reject(result) : Promise.resolve(result)));

  return { request } satisfies HttpClient;
};
const instant = { sleep: vi.fn(() => Promise.resolve()), jitterMs: () => 0 };

describe('getReadOnlyRetryDelay', () => {
  it('reads Retry-After from a 503', () => {
    expect(getReadOnlyRetryDelay(rejection(503, { 'retry-after': '7' }))).toBe(7);
  });

  it.each([
    ['a 503 without Retry-After (plain maintenance mode)', rejection(503, {})],
    ['another status', rejection(500)],
    ['an unparsable Retry-After', rejection(503, { 'retry-after': 'soon' })],
    ['a network error', new HttpNetworkError('Network error')],
    ['not an error from the client', new Error('x')],
  ])('ignores %s', (_, error) => {
    expect(getReadOnlyRetryDelay(error)).toBeNull();
  });
});

describe('withReadOnlyRetry', () => {
  it('passes a successful response through without waiting', async () => {
    instant.sleep.mockClear();
    const client = clientFrom(ok);

    await expect(withReadOnlyRetry(client, instant).request(config)).resolves.toBe(ok);
    expect(client.request).toHaveBeenCalledTimes(1);
    expect(instant.sleep).not.toHaveBeenCalled();
  });

  it('sends the same request again after the Retry-After wait and returns the later response', async () => {
    instant.sleep.mockClear();
    const client = clientFrom(rejection(503), rejection(503), ok);

    await expect(withReadOnlyRetry(client, instant).request(config)).resolves.toBe(ok);
    expect(client.request).toHaveBeenCalledTimes(3);
    expect(client.request).toHaveBeenNthCalledWith(3, config);
    expect(instant.sleep).toHaveBeenNthCalledWith(1, 5000, undefined);
  });

  it('adds jitter and caps the wait', async () => {
    const sleep = vi.fn(() => Promise.resolve());
    const client = clientFrom(rejection(503, { 'retry-after': '120' }), ok);

    await withReadOnlyRetry(client, { sleep, jitterMs: () => 250, maxDelaySeconds: 10 }).request(config);
    expect(sleep).toHaveBeenCalledWith(10250, undefined);
  });

  it('waits at least a second even when Retry-After is 0', async () => {
    const sleep = vi.fn(() => Promise.resolve());
    const client = clientFrom(rejection(503, { 'retry-after': '0' }), ok);

    await withReadOnlyRetry(client, { sleep, jitterMs: () => 0 }).request(config);
    expect(sleep).toHaveBeenCalledWith(1000, undefined);
  });

  it('gives up after maxRetries and throws the last rejection', async () => {
    const last = rejection(503);
    const client = clientFrom(rejection(503), rejection(503), last);

    await expect(withReadOnlyRetry(client, { ...instant, maxRetries: 2 }).request(config)).rejects.toBe(last);
    expect(client.request).toHaveBeenCalledTimes(3);
  });

  it('does not retry other failures', async () => {
    const failure = rejection(422, {});
    const client = clientFrom(failure);

    await expect(withReadOnlyRetry(client, instant).request(config)).rejects.toBe(failure);
    expect(client.request).toHaveBeenCalledTimes(1);
  });

  it('stops waiting when the visit is cancelled', async () => {
    const controller = new AbortController();
    const client = clientFrom(rejection(503), ok);
    const promise = withReadOnlyRetry(client, { jitterMs: () => 0 }).request({ ...config, signal: controller.signal });
    await Promise.resolve();
    controller.abort();

    await expect(promise).rejects.toBeInstanceOf(HttpCancelledError);
    expect(client.request).toHaveBeenCalledTimes(1);
  });
});
