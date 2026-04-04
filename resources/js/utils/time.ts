import {
  TimezoneSelection,
  TimezoneSelectionByOffset,
  TimeZoneSelectionType,
} from '@/model/timezone-selection';
import { pad } from '@/utils/pad';

export const offsetZoneRegex = /^(?:Etc\/)?(?:GMT|UTC)\+?(-?\d{1,2})(?::?(\d{2}))?$/i;

// Fixed reference dates to capture both standard and daylight time abbreviations
const STANDARD_TIME_DATE = new Date(Date.UTC(2024, 0, 15)); // January for standard time
const DAYLIGHT_TIME_DATE = new Date(Date.UTC(2024, 6, 15)); // July for daylight time

const getTimezoneDisplayName = (timezone: string, locale: string): string => {
  try {
    const parts = new Intl.DateTimeFormat(locale, {
      timeZone: timezone,
      timeZoneName: 'longGeneric',
    }).formatToParts(new Date());
    return parts.find(p => p.type === 'timeZoneName')?.value ?? timezone;
  } catch {
    return timezone;
  }
};

const getInitials = (name: string): string =>
  name.split(/\s+/).map(word => word[0]).join('');

const formatTzName = (timezone: string, format: Intl.DateTimeFormatOptions['timeZoneName'], date: Date): string | undefined => {
  try {
    return new Intl.DateTimeFormat('en', { timeZone: timezone, timeZoneName: format })
      .formatToParts(date)
      .find(p => p.type === 'timeZoneName')?.value;
  } catch {
    return undefined;
  }
};

const getTimezoneAbbreviations = (timezone: string): string[] => {
  const abbrevs = new Set<string>();

  for (const date of [STANDARD_TIME_DATE, DAYLIGHT_TIME_DATE]) {
    // Use short format directly where available (e.g. EST, EDT in Chrome)
    const short = formatTzName(timezone, 'short', date);
    if (short && !/^(GMT|UTC)[+-]/.test(short)) {
      abbrevs.add(short);
    }

    // Derive abbreviation from long name initials: "Eastern Daylight Time" → "EDT"
    const long = formatTzName(timezone, 'long', date);
    if (long) {
      const initials = getInitials(long);
      if (initials.length >= 2) abbrevs.add(initials);
    }
  }

  // longGeneric drops the Standard/Summer qualifier:
  // "Central European Time" → "CET" (vs "CEST" from "Central European Standard/Summer Time")
  const generic = formatTzName(timezone, 'longGeneric', STANDARD_TIME_DATE);
  if (generic) {
    const initials = getInitials(generic);
    if (initials.length >= 2) abbrevs.add(initials);
  }

  return Array.from(abbrevs);
};

const getCurrentTimezoneAbbreviation = (timezone: string, aliases: string[]): string | undefined => {
  const now = new Date();
  const short = formatTzName(timezone, 'short', now);
  if (short && !/^(GMT|UTC)[+-]/.test(short) && aliases.includes(short)) return short;
  const long = formatTzName(timezone, 'long', now);
  if (long) {
    const initials = getInitials(long);
    if (initials.length >= 2 && aliases.includes(initials)) return initials;
  }
  return undefined;
};

export const getTimezoneValue = (timezone: string, locale = 'en') => {
  const displayName = getTimezoneDisplayName(timezone, locale);
  const abbreviations = getTimezoneAbbreviations(timezone);
  const currentAlias = getCurrentTimezoneAbbreviation(timezone, abbreviations);
  const englishName = locale !== 'en' ? getTimezoneDisplayName(timezone, 'en') : undefined;
  // When showing a localized name, also store the English words for search
  const searchTerms = englishName && englishName !== displayName
    ? englishName.toLowerCase().split(/\s+/).filter(Boolean)
    : undefined;
  return {
    value: timezone,
    label: timezone,
    description: displayName !== timezone ? displayName : undefined,
    aliases: abbreviations.length > 0 ? abbreviations : undefined,
    currentAlias,
    searchTerms,
  };
};

export const rangeLimit = (value: number, min: number, max: number): number => {
  let log = false;
  let result = value;

  if (!isNaN(min) && value < min) {
    result = min;
    log = true;
  } else if (!isNaN(max) && value > max) {
    result = max;
    log = true;
  }

  if (log) {
    console.warn(new RangeError(`Number between ${min} and ${max} is expected, got ${value}`));
  }
  return result;
};

export const rangeLimitInput = (target: unknown): number => {
  if (!(target instanceof HTMLInputElement)) {
    console.warn(`target must be an input, received ${typeof target}`);
    return NaN;
  }

  const value = parseInt(target.value, 10);
  const min = parseInt(target.min, 10);
  const max = parseInt(target.max, 10);
  return rangeLimit(value, min, max);
};

export const toTwentyFourHours = (value: number, isAm: boolean) => {
  const twelveHourValue = rangeLimit(value, 1, 12);

  const baseValue = isAm ? 0 : 12;
  return twelveHourValue === 12 ? baseValue : twelveHourValue + baseValue;
};

export const toTwelveHours = (value: number) => {
  const twentyFourHourValue = rangeLimit(value, 0, 23);

  const modResult = twentyFourHourValue % 12;
  return modResult === 0 ? 12 : modResult;
};

interface HoursCoercionResult {
  hours: number;
  isAm: boolean;
}

export const coerceToTwelveHours = (value: number): HoursCoercionResult | null => {
  const twentyFourHours = rangeLimit(value, 0, 23);

  if (twentyFourHours > 12) {
    return {
      hours: limitToTwelveHours(twentyFourHours),
      isAm: false,
    };
  }

  if (twentyFourHours < 1) {
    return {
      hours: limitToTwelveHours(twentyFourHours),
      isAm: true,
    };
  }

  // No coercion needed
  return null;
};


export const limitToTwelveHours = (value: number): number => {
  const twentyFourHours = rangeLimit(value, 0, 23);

  if (twentyFourHours > 12) {
    return twentyFourHours - 12;
  }

  return twentyFourHours < 1 ? 12 : twentyFourHours;
};

export const limitHours = (value: number): number => {
  return rangeLimit(value, 0, 23);
};
export const limitMinutesSeconds = (value: number): number => {
  return rangeLimit(value, 0, 59);
};
export const limitMonth = (value: number): number => {
  return rangeLimit(value, 1, 12);
};
export const limitDate = (value: number): number => {
  return rangeLimit(value, 1, 31);
};

export const getUtcOffsetString = (zoneSelectionByOffset: TimezoneSelectionByOffset) => {
  return (zoneSelectionByOffset.hours < 0 ? '-' : '+')
    + pad(Math.abs(zoneSelectionByOffset.hours), 2)
    + ':'
    + pad(zoneSelectionByOffset.minutes, 2);
};

export const convertTimeZoneSelectionToString = (currentTimezone: TimezoneSelection) => {
  switch (currentTimezone.type) {
    case TimeZoneSelectionType.OFFSET:
      return `GMT${getUtcOffsetString(currentTimezone)}`;
    case TimeZoneSelectionType.ZONE_NAME:
      return currentTimezone.name;
  }
};

/**
 * Calculates the client's clock offset based on NTP timestamps.
 * @param t0 - Client send time (ms)
 * @param t1 - Server receive time (ms)
 * @param t2 - Server transmit time (ms)
 * @param t3 - Client receive time (ms)
 * @returns The estimated offset in milliseconds
 */
export const calculateNtpOffset = (t0: number | undefined, t1: number | undefined, t2: number | undefined, t3: number | undefined): number => {
  if (typeof t0 !== 'number' || typeof t1 !== 'number' || typeof t2 !== 'number' || typeof t3 !== 'number') {
    return NaN;
  }
  return ((t1 - t0) + (t2 - t3)) / 2;
};

export const normalizeTimeString = (value: string) => (
  value.length === 5 ? `${value}:00` : value
);
