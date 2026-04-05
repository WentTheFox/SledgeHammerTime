import {
  TimezoneSelection,
  TimezoneSelectionByName,
  TimezoneSelectionByOffset,
  TimeZoneSelectionType,
} from '@/model/timezone-selection';
import { DefaultDTL } from '@/utils/dtl';
import {
  coerceToTwelveHours,
  getTimezoneAbbreviationAtDate,
  getTimezoneValue,
  getUtcOffsetString,
  rangeLimit,
  toTwelveHours,
  toTwentyFourHours,
} from '@/utils/time';
import { afterAll, afterEach, beforeAll, beforeEach, describe, expect, it, vi } from 'vitest';

describe('toTwentyFourHours', () => {
  const AM = true;
  const PM = false;

  it('should convert times correctly', () => {
    expect(toTwentyFourHours(12, AM)).to.eql(0);
    expect(toTwentyFourHours(1, AM)).to.eql(1);
    expect(toTwentyFourHours(2, AM)).to.eql(2);
    expect(toTwentyFourHours(3, AM)).to.eql(3);
    expect(toTwentyFourHours(4, AM)).to.eql(4);
    expect(toTwentyFourHours(5, AM)).to.eql(5);
    expect(toTwentyFourHours(6, AM)).to.eql(6);
    expect(toTwentyFourHours(7, AM)).to.eql(7);
    expect(toTwentyFourHours(8, AM)).to.eql(8);
    expect(toTwentyFourHours(9, AM)).to.eql(9);
    expect(toTwentyFourHours(10, AM)).to.eql(10);
    expect(toTwentyFourHours(11, AM)).to.eql(11);
    expect(toTwentyFourHours(12, PM)).to.eql(12);
    expect(toTwentyFourHours(1, PM)).to.eql(13);
    expect(toTwentyFourHours(2, PM)).to.eql(14);
    expect(toTwentyFourHours(3, PM)).to.eql(15);
    expect(toTwentyFourHours(4, PM)).to.eql(16);
    expect(toTwentyFourHours(5, PM)).to.eql(17);
    expect(toTwentyFourHours(6, PM)).to.eql(18);
    expect(toTwentyFourHours(7, PM)).to.eql(19);
    expect(toTwentyFourHours(8, PM)).to.eql(20);
    expect(toTwentyFourHours(9, PM)).to.eql(21);
    expect(toTwentyFourHours(10, PM)).to.eql(22);
    expect(toTwentyFourHours(11, PM)).to.eql(23);
  });
});

describe('toTwelveHours', () => {
  it('should convert times correctly', () => {
    expect(toTwelveHours(0)).to.eql(12);
    expect(toTwelveHours(1)).to.eql(1);
    expect(toTwelveHours(2)).to.eql(2);
    expect(toTwelveHours(3)).to.eql(3);
    expect(toTwelveHours(4)).to.eql(4);
    expect(toTwelveHours(5)).to.eql(5);
    expect(toTwelveHours(6)).to.eql(6);
    expect(toTwelveHours(7)).to.eql(7);
    expect(toTwelveHours(8)).to.eql(8);
    expect(toTwelveHours(9)).to.eql(9);
    expect(toTwelveHours(10)).to.eql(10);
    expect(toTwelveHours(11)).to.eql(11);
    expect(toTwelveHours(12)).to.eql(12);
    expect(toTwelveHours(13)).to.eql(1);
    expect(toTwelveHours(14)).to.eql(2);
    expect(toTwelveHours(15)).to.eql(3);
    expect(toTwelveHours(16)).to.eql(4);
    expect(toTwelveHours(17)).to.eql(5);
    expect(toTwelveHours(18)).to.eql(6);
    expect(toTwelveHours(19)).to.eql(7);
    expect(toTwelveHours(20)).to.eql(8);
    expect(toTwelveHours(21)).to.eql(9);
    expect(toTwelveHours(22)).to.eql(10);
    expect(toTwelveHours(23)).to.eql(11);
  });
});

describe('coerceHours', () => {
  it('should provide the correct output', () => {
    expect(coerceToTwelveHours(0)).to.eql({ hours: 12, isAm: true });
    expect(coerceToTwelveHours(1)).to.eql(null);
    expect(coerceToTwelveHours(2)).to.eql(null);
    expect(coerceToTwelveHours(3)).to.eql(null);
    expect(coerceToTwelveHours(4)).to.eql(null);
    expect(coerceToTwelveHours(5)).to.eql(null);
    expect(coerceToTwelveHours(6)).to.eql(null);
    expect(coerceToTwelveHours(7)).to.eql(null);
    expect(coerceToTwelveHours(8)).to.eql(null);
    expect(coerceToTwelveHours(9)).to.eql(null);
    expect(coerceToTwelveHours(10)).to.eql(null);
    expect(coerceToTwelveHours(11)).to.eql(null);
    expect(coerceToTwelveHours(12)).to.eql(null);
    expect(coerceToTwelveHours(13)).to.eql({ hours: 1, isAm: false });
    expect(coerceToTwelveHours(14)).to.eql({ hours: 2, isAm: false });
    expect(coerceToTwelveHours(15)).to.eql({ hours: 3, isAm: false });
    expect(coerceToTwelveHours(16)).to.eql({ hours: 4, isAm: false });
    expect(coerceToTwelveHours(17)).to.eql({ hours: 5, isAm: false });
    expect(coerceToTwelveHours(18)).to.eql({ hours: 6, isAm: false });
    expect(coerceToTwelveHours(19)).to.eql({ hours: 7, isAm: false });
    expect(coerceToTwelveHours(20)).to.eql({ hours: 8, isAm: false });
    expect(coerceToTwelveHours(21)).to.eql({ hours: 9, isAm: false });
    expect(coerceToTwelveHours(22)).to.eql({ hours: 10, isAm: false });
    expect(coerceToTwelveHours(23)).to.eql({ hours: 11, isAm: false });
  });
});

describe('rangeLimit', () => {
  let consoleWarn: typeof console.warn;
  beforeAll(() => {
    consoleWarn = console.warn;
    console.warn = () => undefined;
  });
  afterAll(() => {
    console.warn = consoleWarn;
  });

  it('should limit ranges correctly', () => {
    expect(rangeLimit(0, 1, 2)).to.eql(1);
    expect(rangeLimit(1, 1, 2)).to.eql(1);
    expect(rangeLimit(2, 1, 2)).to.eql(2);
    expect(rangeLimit(3, 1, 2)).to.eql(2);
  });
});

describe('getDefaultInitialDateTime', () => {
  it('should return a date with the seconds set to 0', () => {
    const result = DefaultDTL.getDefaultInitialDateTime({
      type: TimeZoneSelectionType.ZONE_NAME,
      name: 'UTC',
    }, undefined);
    expect(result).toHaveLength(2);
    expect(result[1]).toMatch(/:00$/);
  });
  // FIXME
  it.skip('should return the same timestamp when passed an initial value', () => {
    const result = DefaultDTL.getDefaultInitialDateTime({
      type: TimeZoneSelectionType.ZONE_NAME,
      name: 'UTC',
    }, '55000');
    expect(result).toHaveLength(2);
    expect(result[1]).toMatch(/:55$/);
  });
});

describe('DTL.getDefaultInitialTimezoneSelection', () => {
  const mockGuessedTimezone = 'Mock/Guess';
  const mockGuessedTimezoneReturnValue: ReturnType<typeof DefaultDTL.getDefaultInitialTimezoneSelection> = {
    type: TimeZoneSelectionType.ZONE_NAME,
    name: mockGuessedTimezone,
  };

  it('should return the native timezone when it\'s available in date library', () => {
    const mockTimezone = 'Mock/Constant';
    const systemApiSpy = vi.spyOn(Intl, 'DateTimeFormat').mockReturnValue({
      resolvedOptions: () => ({
        timeZone: mockTimezone,
        // eslint-disable-next-line @typescript-eslint/no-explicit-any
      }) as any,
      // eslint-disable-next-line @typescript-eslint/no-explicit-any
    } as any);
    try {
      const result = DefaultDTL.getDefaultInitialTimezoneSelection();
      expect(result).toEqual({ ...mockGuessedTimezoneReturnValue, name: mockTimezone });
    } finally {
      systemApiSpy.mockRestore();
    }
  });

  it('should return the guessed timezone when there is an error', () => {
    const consoleErrorSpy = vi.spyOn(console, 'error').mockReturnValue(undefined);
    const mockError = new Error('mock error');
    const systemApiSpy = vi.spyOn(Intl, 'DateTimeFormat').mockImplementation(() => {
      throw mockError;
    });
    try {
      const result = DefaultDTL.getDefaultInitialTimezoneSelection();
      expect(result).toEqual({ type: TimeZoneSelectionType.ZONE_NAME, name: 'Etc/UTC' });
      expect(consoleErrorSpy).toHaveBeenCalledOnce();
      expect(consoleErrorSpy).toHaveBeenCalledWith("Could not determine initial timezone", mockError);
    } finally {
      consoleErrorSpy.mockRestore();
      systemApiSpy.mockRestore();
    }
  });

  it.each([
    { input: 'GMT+0', expectedHours: 0, expectedMinutes: 0 },
    { input: 'GMT+1', expectedHours: 1, expectedMinutes: 0 },
    { input: 'GMT+10', expectedHours: 10, expectedMinutes: 0 },
    { input: 'GMT+1030', expectedHours: 10, expectedMinutes: 30 },
    { input: 'GMT+10:30', expectedHours: 10, expectedMinutes: 30 },
    { input: 'GMT-0', expectedHours: 0, expectedMinutes: 0 },
    { input: 'GMT-1', expectedHours: -1, expectedMinutes: 0 },
    { input: 'GMT-10', expectedHours: -10, expectedMinutes: 0 },
    { input: 'GMT-1030', expectedHours: -10, expectedMinutes: 30 },
    { input: 'GMT-10:30', expectedHours: -10, expectedMinutes: 30 },
    { input: 'Etc/GMT-0', expectedHours: 0, expectedMinutes: 0 },
    { input: 'Etc/GMT-1', expectedHours: -1, expectedMinutes: 0 },
    { input: 'Etc/GMT-10', expectedHours: -10, expectedMinutes: 0 },
    { input: 'Etc/GMT-1030', expectedHours: -10, expectedMinutes: 30 },
    { input: 'Etc/GMT-10:30', expectedHours: -10, expectedMinutes: 30 },
  ])('should return the parsed GMT offset when default timezone prop is $input', ({
    input,
    expectedHours,
    expectedMinutes,
  }) => {
    const expected: TimezoneSelection = {
      type: TimeZoneSelectionType.OFFSET,
      hours: expectedHours,
      minutes: expectedMinutes,
    };
    expect(DefaultDTL.getDefaultInitialTimezoneSelection(input)).toEqual(expected);
  });
});

describe('getUtcOffsetString', () => {
  it('should return the correct offset string', () => {
    const defaultObject: TimezoneSelectionByOffset = {
      type: TimeZoneSelectionType.OFFSET,
      hours: 0,
      minutes: 0,
    };
    expect(getUtcOffsetString(defaultObject)).toEqual('+00:00');
    expect(getUtcOffsetString({ ...defaultObject, hours: 1, minutes: 1 })).toEqual('+01:01');
    expect(getUtcOffsetString({ ...defaultObject, hours: -14, minutes: 30 })).toEqual('-14:30');
  });
});

describe('DTLValue.replaceZone', () => {
  it('should return a timestamp with the correct utc offset', () => {
    const now = DefaultDTL.fromTimestampMsUtc(0);
    const defaultObject: TimezoneSelectionByOffset = {
      type: TimeZoneSelectionType.OFFSET,
      hours: 0,
      minutes: 0,
    };
    expect(now.replaceZone(defaultObject).getUtcOffsetMinutes()).toEqual(0);
    expect(now.replaceZone({
      ...defaultObject,
      hours: 1,
      minutes: 1,
    }).getUtcOffsetMinutes()).toEqual(61);
    expect(now.replaceZone({
      ...defaultObject,
      hours: -14,
      minutes: 30,
    }).getUtcOffsetMinutes()).toEqual(-870);
  });
  it('should return a timestamp with the correct zone name', () => {
    const now = DefaultDTL.fromTimestampMsUtc(0);
    const defaultObject: TimezoneSelectionByName = {
      type: TimeZoneSelectionType.ZONE_NAME,
      name: 'Europe/Budapest',
    };
    expect(now.replaceZone(defaultObject).getUtcOffsetMinutes()).toEqual(60);
  });
});

describe('getTimezoneValue', () => {
  describe('aliases', () => {
    it.each([
      ['Europe/Paris', ['CET', 'CEST']],
      ['America/New_York', ['EST', 'EDT']],
      ['America/Los_Angeles', ['PST', 'PDT']],
      ['America/Chicago', ['CST', 'CDT']],
      ['Australia/Sydney', ['AEST', 'AEDT']],
      ['Asia/Tokyo', ['JST']],
      ['Asia/Kolkata', ['IST']],
      ['Europe/London', ['GMT', 'BST']],
    ] as [string, string[]][])('should include the expected abbreviations for %s', (timezone, expected) => {
      const { aliases } = getTimezoneValue(timezone);
      for (const abbrev of expected) {
        expect(aliases, `expected aliases to contain ${abbrev}`).toContain(abbrev);
      }
    });

    it('should return undefined aliases for an offset-only timezone', () => {
      // Etc/GMT+5 has no named abbreviations, all Intl formats return GMT offsets
      const { aliases } = getTimezoneValue('Etc/GMT+5');
      expect(aliases).toBeUndefined();
    });
  });

  describe('currentAlias', () => {
    beforeEach(() => {
      vi.useFakeTimers();
    });
    afterEach(() => {
      vi.useRealTimers();
    });

    it('should always be one of the known aliases when defined', () => {
      const timezones = ['Europe/Paris', 'America/New_York', 'Asia/Tokyo', 'Australia/Sydney', 'Europe/London'];
      const dates = [new Date('2024-01-15T12:00:00Z'), new Date('2024-07-15T12:00:00Z')];
      for (const tz of timezones) {
        for (const date of dates) {
          vi.setSystemTime(date);
          const { aliases, currentAlias } = getTimezoneValue(tz);
          if (currentAlias !== undefined) {
            expect(aliases, `${tz} on ${date.toISOString()}: currentAlias "${currentAlias}" not in aliases`).toContain(currentAlias);
          }
        }
      }
    });

    // Node.js returns proper short abbreviations for North American timezones,
    // so these can assert the exact expected value in all environments
    it.each([
      ['America/New_York', '2024-01-15T12:00:00Z', 'EST'],
      ['America/New_York', '2024-07-15T12:00:00Z', 'EDT'],
      ['America/Los_Angeles', '2024-01-15T12:00:00Z', 'PST'],
      ['America/Los_Angeles', '2024-07-15T12:00:00Z', 'PDT'],
      ['America/Chicago', '2024-01-15T12:00:00Z', 'CST'],
      ['America/Chicago', '2024-07-15T12:00:00Z', 'CDT'],
    ] as [string, string, string][])('%s on %s should have currentAlias %s', (timezone, dateStr, expected) => {
      vi.setSystemTime(new Date(dateStr));
      expect(getTimezoneValue(timezone).currentAlias).toBe(expected);
    });

    it('should always return JST for Asia/Tokyo regardless of season', () => {
      vi.setSystemTime(new Date('2024-01-15T12:00:00Z'));
      expect(getTimezoneValue('Asia/Tokyo').currentAlias).toBe('JST');
      vi.setSystemTime(new Date('2024-07-15T12:00:00Z'));
      expect(getTimezoneValue('Asia/Tokyo').currentAlias).toBe('JST');
    });
  });

  describe('getTimezoneAbbreviationAtDate', () => {
    it('returns the winter alias for a winter date', () => {
      const { aliases } = getTimezoneValue('America/New_York');
      const result = getTimezoneAbbreviationAtDate('America/New_York', aliases!, new Date('2024-12-16T12:00:00Z'));
      expect(result).toBe('EST');
    });

    it('returns the summer alias for a summer date', () => {
      const { aliases } = getTimezoneValue('America/New_York');
      const result = getTimezoneAbbreviationAtDate('America/New_York', aliases!, new Date('2024-07-15T12:00:00Z'));
      expect(result).toBe('EDT');
    });

    it('returns winter alias for Europe/Berlin on December 16', () => {
      const { aliases } = getTimezoneValue('Europe/Berlin');
      const result = getTimezoneAbbreviationAtDate('Europe/Berlin', aliases!, new Date('2024-12-16T12:00:00Z'));
      // December is CET (UTC+1), not CEST (UTC+2)
      expect(result).not.toBe('CEST');
      expect(aliases).toContain(result);
    });

    it('returns summer alias for Europe/Berlin on July 15', () => {
      const { aliases } = getTimezoneValue('Europe/Berlin');
      const result = getTimezoneAbbreviationAtDate('Europe/Berlin', aliases!, new Date('2024-07-15T12:00:00Z'));
      expect(result).not.toBe('CET');
      expect(aliases).toContain(result);
    });

    it('returns undefined for an offset-only timezone', () => {
      const result = getTimezoneAbbreviationAtDate('Etc/GMT+5', [], new Date('2024-12-16T12:00:00Z'));
      expect(result).toBeUndefined();
    });

    it('returns undefined when aliases array does not include the computed abbreviation', () => {
      // Passing an empty aliases array should always return undefined
      const result = getTimezoneAbbreviationAtDate('America/New_York', [], new Date('2024-12-16T12:00:00Z'));
      expect(result).toBeUndefined();
    });

    it('is distinct from currentAlias when the timezone observes DST and dates are in different seasons', () => {
      vi.setSystemTime(new Date('2024-07-15T12:00:00Z')); // summer: CEST / EDT / etc.
      const { aliases, currentAlias } = getTimezoneValue('America/New_York');
      const winterAlias = getTimezoneAbbreviationAtDate('America/New_York', aliases!, new Date('2024-12-16T12:00:00Z'));
      expect(currentAlias).toBe('EDT');
      expect(winterAlias).toBe('EST');
      expect(winterAlias).not.toBe(currentAlias);
    });
  });
});
