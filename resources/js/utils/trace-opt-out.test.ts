import { describe, expect, it } from 'vitest';
import { buildTraceOptOutCookie, hasTraceOptOutCookie, TRACE_OPT_OUT_COOKIE } from './trace-opt-out';

const fiveYearsInSeconds = 5 * 365 * 24 * 60 * 60;

describe('trace opt-out cookie', () => {
  it('is set for five years, for the whole site and readable by JavaScript', () => {
    const cookie = buildTraceOptOutCookie(true, true);

    expect(cookie).toBe(`${TRACE_OPT_OUT_COOKIE}=1; Max-Age=${fiveYearsInSeconds}; Path=/; SameSite=Lax; Secure`);
    expect(cookie).not.toMatch(/HttpOnly/i);
  });

  it('is not marked Secure on plain http (local development)', () => {
    expect(buildTraceOptOutCookie(true, false)).not.toContain('Secure');
  });

  it('is removed by opting back in', () => {
    expect(buildTraceOptOutCookie(false, true)).toContain('Max-Age=0');
  });

  it('is found among other cookies and only with the exact value', () => {
    expect(hasTraceOptOutCookie(`a=b; ${TRACE_OPT_OUT_COOKIE}=1; c=d`)).toBe(true);
    expect(hasTraceOptOutCookie('')).toBe(false);
    expect(hasTraceOptOutCookie(`${TRACE_OPT_OUT_COOKIE}=0`)).toBe(false);
    expect(hasTraceOptOutCookie(`x${TRACE_OPT_OUT_COOKIE}=1`)).toBe(false);
  });
});
