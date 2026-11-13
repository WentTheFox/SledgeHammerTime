import { afterEach, beforeEach, describe, expect, it, vi } from 'vitest';
import {
  ASSUMED_COOKIE_LIFETIME_MS,
  buildTraceOptOutCookie,
  getTraceOptOutExpiry,
  hasTraceOptOutCookie,
  TRACE_OPT_OUT_COOKIE,
} from './trace-opt-out';

const maxAgeInSeconds = 400 * 24 * 60 * 60;

describe('trace opt-out cookie', () => {
  it('is set for 400 days, for the whole site and readable by JavaScript', () => {
    const now = new Date();
    const cookie = buildTraceOptOutCookie(true, true, now);

    expect(cookie).toBe(`${TRACE_OPT_OUT_COOKIE}=${now.getTime()}; Max-Age=${maxAgeInSeconds}; Path=/; SameSite=Lax; Secure`);
    expect(cookie).not.toMatch(/HttpOnly/i);
  });

  it('is not marked Secure on plain http (local development)', () => {
    expect(buildTraceOptOutCookie(true, false)).not.toContain('Secure');
  });

  it('is removed by opting back in', () => {
    expect(buildTraceOptOutCookie(false, true)).toContain('Max-Age=0');
  });

  it('is found among other cookies and with any numeric value', () => {
    expect(hasTraceOptOutCookie(`a=b; ${TRACE_OPT_OUT_COOKIE}=1; c=d`)).toBe(true);
    expect(hasTraceOptOutCookie(`${TRACE_OPT_OUT_COOKIE}=0`)).toBe(true);
    expect(hasTraceOptOutCookie(`${TRACE_OPT_OUT_COOKIE}=1794546078708`)).toBe(true);
    expect(hasTraceOptOutCookie('')).toBe(false);
    expect(hasTraceOptOutCookie(`x${TRACE_OPT_OUT_COOKIE}=1`)).toBe(false);
  });
});

describe('getTraceOptOutExpiry', () => {
  const now = Date.parse('2026-11-13T12:00:00.000Z');

  beforeEach(() => {
    vi.useFakeTimers();
    vi.setSystemTime(now);
  });
  afterEach(() => {
    vi.useRealTimers();
    vi.unstubAllGlobals();
  });

  const stubBrowser = (cookie: string, cookieStore?: { get: () => Promise<unknown> }) => {
    vi.stubGlobal('document', { cookie });
    vi.stubGlobal('window', cookieStore ? { cookieStore } : {});
  };

  it('is null when the visitor is not opted out', async () => {
    stubBrowser('a=b', { get: async () => null });

    expect(await getTraceOptOutExpiry()).toBeNull();
  });

  it('is what the browser reports', async () => {
    const reported = now + 30 * 24 * 60 * 60 * 1000;
    stubBrowser(`${TRACE_OPT_OUT_COOKIE}=1`, { get: async () => ({ name: TRACE_OPT_OUT_COOKIE, value: '1', expires: reported }) });

    expect(await getTraceOptOutExpiry()).toBe(reported);
  });

  it('assumes 400 days from now when the browser reports the cookie without an expiry (Firefox)', async () => {
    stubBrowser(`${TRACE_OPT_OUT_COOKIE}=1`, { get: async () => ({ name: TRACE_OPT_OUT_COOKIE, value: '1' }) });

    expect(await getTraceOptOutExpiry()).toBe(now + ASSUMED_COOKIE_LIFETIME_MS);
    expect(ASSUMED_COOKIE_LIFETIME_MS).toBe(400 * 24 * 60 * 60 * 1000);
  });

  it('assumes it as well when the browser has no Cookie Store API', async () => {
    stubBrowser(`${TRACE_OPT_OUT_COOKIE}=1`);

    expect(await getTraceOptOutExpiry()).toBe(now + ASSUMED_COOKIE_LIFETIME_MS);
  });

  it('assumes it when asking the Cookie Store fails', async () => {
    stubBrowser(`${TRACE_OPT_OUT_COOKIE}=1`, { get: async () => { throw new Error('denied'); } });

    expect(await getTraceOptOutExpiry()).toBe(now + ASSUMED_COOKIE_LIFETIME_MS);
  });
});
