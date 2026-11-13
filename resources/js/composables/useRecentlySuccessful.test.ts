import { effectScope } from 'vue';
import { afterEach, beforeEach, describe, expect, it, vi } from 'vitest';
import { useRecentlySuccessful } from './useRecentlySuccessful';

describe('useRecentlySuccessful', () => {
  beforeEach(() => vi.useFakeTimers());
  afterEach(() => vi.useRealTimers());

  it('sets the flag and clears it after the duration', () => {
    const form = { recentlySuccessful: false };
    const mark = useRecentlySuccessful();

    mark(form, 2000);
    expect(form.recentlySuccessful).toBe(true);
    vi.advanceTimersByTime(1999);
    expect(form.recentlySuccessful).toBe(true);
    vi.advanceTimersByTime(1);
    expect(form.recentlySuccessful).toBe(false);
  });

  it('starts the period over when it is called again for the same form', () => {
    const form = { recentlySuccessful: false };
    const mark = useRecentlySuccessful();

    mark(form, 2000);
    vi.advanceTimersByTime(1500);
    mark(form, 2000);
    vi.advanceTimersByTime(1500);
    expect(form.recentlySuccessful).toBe(true);
    vi.advanceTimersByTime(500);
    expect(form.recentlySuccessful).toBe(false);
  });

  it('keeps the forms apart', () => {
    const first = { recentlySuccessful: false };
    const second = { recentlySuccessful: false };
    const mark = useRecentlySuccessful();

    mark(first, 1000);
    vi.advanceTimersByTime(500);
    mark(second, 1000);
    vi.advanceTimersByTime(500);
    expect(first.recentlySuccessful).toBe(false);
    expect(second.recentlySuccessful).toBe(true);
    vi.advanceTimersByTime(500);
    expect(second.recentlySuccessful).toBe(false);
  });

  it('uses the duration Inertia is configured with by default', () => {
    const form = { recentlySuccessful: false };
    const mark = useRecentlySuccessful();

    mark(form);
    vi.advanceTimersByTime(1999);
    expect(form.recentlySuccessful).toBe(true);
    vi.advanceTimersByTime(1);
    expect(form.recentlySuccessful).toBe(false);
  });

  it('cancels the pending clears when its scope is disposed', () => {
    const first = { recentlySuccessful: false };
    const second = { recentlySuccessful: false };
    const scope = effectScope();
    const mark = scope.run(() => useRecentlySuccessful())!;

    mark(first, 2000);
    mark(second, 2000);
    scope.stop();
    vi.advanceTimersByTime(5000);
    expect(first.recentlySuccessful).toBe(true);
    expect(second.recentlySuccessful).toBe(true);
  });
});
