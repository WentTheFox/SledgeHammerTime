import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { DateTimeLibraryValue, DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { dateFnsLocaleMap } from '@/date-fns';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import {
  AvailableLanguage,
  FALLBACK_LANGUAGE,
  LANGUAGES,
  LatestLanguageConfigType,
} from '@/utils/language-settings';
import { getUtcOffsetString, rangeLimit } from '@/utils/time';
import { TZDate } from '@date-fns/tz';
import {
  addDays,
  addYears,
  format,
  formatDistanceToNowStrict,
  getDaysInMonth,
  getUnixTime,
  Locale,
  parse,
  setHours,
  setMinutes,
  setSeconds,
} from 'date-fns';

// Format constants
const isoTimeFormat = 'HH:mm:ss';
const isoFormattingDateFormat = 'yyyy-MM-dd';
const isoParsingDateFormat = 'yyyy-MM-dd';
const isoFormat = `${isoFormattingDateFormat} ${isoTimeFormat}`;
const urlFormat = 'yyyyMMdd.HHmmss';

// Default values
const defaultDate = '2023-01-01';
const defaultTime = '00:00:00';

// Regular expression for parsing offset timezone hints
const offsetZoneRegex = /^GMT([+-]\d{1,2})(?::?(\d{2}))?$/i;

const timezoneNames = Intl.supportedValuesOf('timeZone')
  .filter((name) => !name.startsWith('Etc/GMT'))
  .sort((a, b) => a.localeCompare(b));

const getDiscordToUnicodeFormat = (format: MessageTimestampFormat, language: string | undefined): string => {
  const normalizedLanguage = language?.toLowerCase();
  switch (format) {
    case MessageTimestampFormat.SHORT_DATE:
      switch (normalizedLanguage) {
        default:
          return 'P';
      }
    case MessageTimestampFormat.SHORT_TIME:
      switch (normalizedLanguage) {
        case 'en-gb':
          return 'HH:mm';
        default:
          return 'p';
      }
    case MessageTimestampFormat.SHORT_FULL:
      switch (normalizedLanguage) {
        default:
          return `PPP ${getDiscordToUnicodeFormat(MessageTimestampFormat.SHORT_TIME, language)}`;
      }
    case MessageTimestampFormat.LONG_DATE:
      switch (normalizedLanguage) {
        default:
          return 'PPP';
      }
    case MessageTimestampFormat.LONG_TIME:
      switch (normalizedLanguage) {
        case 'en-gb':
          return 'HH:mm:ss';
        default:
          return 'pp';
      }
    case MessageTimestampFormat.LONG_FULL:
      switch (normalizedLanguage) {
        default:
          return `PPPP ${getDiscordToUnicodeFormat(MessageTimestampFormat.SHORT_TIME, language)}`;
      }
    default:
      throw new Error(`Unsupported format: ${format}`);
  }
};

/**
 * Implementation of DateTimeLibraryValue using date-fns
 */
class DateFnsDTLValue extends DateTimeLibraryValue<TZDate, Locale> {
  get value(): TZDate {
    const valueCopy = new TZDate(this.rawValue, this.rawValue.timeZone);
    valueCopy.setTime(this.rawValue.getTime() + this.library.offset);
    return valueCopy;
  }

  set value(value: TZDate) {
    const valueCopy = new TZDate(value, value.timeZone);
    valueCopy.setTime(value.getTime() - this.library.offset);
    this.rawValue = value;
  }

  toString(): string {
    return `[object DateFnsDTLValue(${this.toISOString()})}]`;
  }

  setLocale(locale: DateTimeLibraryLocale<Locale>) {
    const localeLow = locale.lowLevelValue;
    if (!localeLow || !('formatLong' in localeLow)) {
      console.error('[DateFnsDTLValue#setLocale] incomplete locale definition:', localeLow);
    }
    return new DateFnsDTLValue(this.value, { ...this.context, locale });
  }

  getLocale() {
    if (this.locale == null) {
      throw new Error('locale is needed but not set');
    }
    return this.locale;
  }

  local() {
    return new DateFnsDTLValue(new TZDate(this.value), this.context);
  }

  fromNow() {
    return formatDistanceToNowStrict(this.value, {
      locale: this.getLocale().lowLevelValue,
      addSuffix: true,
    });
  }

  addDays(days: number) {
    return new DateFnsDTLValue(addDays(this.value, days), this.context);
  }

  addYears(years: number) {
    return new DateFnsDTLValue(addYears(this.value, years), this.context);
  }

  getFullYear(): number {
    return this.value.getFullYear();
  }

  getMonth(): number {
    return this.value.getMonth();
  }

  getDayOfMonth(): number {
    return this.value.getDate();
  }

  getWeekday(): DateTimeLibraryWeekday {
    return this.value.getDay() as DateTimeLibraryWeekday;
  }

  getHours(): number {
    return this.value.getHours();
  }

  getMinutes(): number {
    return this.value.getMinutes();
  }

  getSeconds(): number {
    return this.value.getSeconds();
  }

  setHours(hours: number): DateTimeLibraryValue<TZDate, Locale> {
    return new DateFnsDTLValue(setHours(this.value, hours), this.context);
  }

  setMinutes(minutes: number): DateTimeLibraryValue<TZDate, Locale> {
    return new DateFnsDTLValue(setMinutes(this.value, minutes), this.context);
  }

  setSeconds(seconds: number): DateTimeLibraryValue<TZDate, Locale> {
    return new DateFnsDTLValue(setSeconds(this.value, seconds), this.context);
  }

  getUtcOffsetMinutes(): number {
    // TZDate provides timezone offset in minutes
    return -this.value.getTimezoneOffset();
  }

  toDate(): Date {
    return this.value;
  }

  toISODateString(): string {
    return format(this.value, isoFormattingDateFormat);
  }

  toISOTimeString(): string {
    return format(this.value, isoTimeFormat);
  }

  toISOString(): string {
    return format(this.value, "yyyy-MM-dd'T'HH:mm:ss.SSSxxx");
  }

  replaceZone(zone: TimezoneSelection) {
    switch (zone.type) {
      case TimeZoneSelectionType.ZONE_NAME:
        return new DateFnsDTLValue(new TZDate(this.value, zone.name), this.context);
      case TimeZoneSelectionType.OFFSET:
        return new DateFnsDTLValue(new TZDate(this.value, getUtcOffsetString(zone)), this.context);
    }
  }

  formatDiscordTimestamp(mtf: MessageTimestampFormat): string {
    const locale = this.getLocale();
    return format(this.value, getDiscordToUnicodeFormat(mtf, locale.name), { locale: locale.lowLevelValue });
  }

  daysInMonth(): number {
    return getDaysInMonth(this.value);
  }

  formatCalendarDateDisplay(): string {
    return format(this.value, 'd', { locale: this.getLocale().lowLevelValue });
  }

  formatHoursDisplay(): string {
    return format(this.value, 'H', { locale: this.getLocale().lowLevelValue });
  }

  formatMinutesDisplay(): string {
    return format(this.value, 'm', { locale: this.getLocale().lowLevelValue });
  }

  formatSecondsDisplay(): string {
    return format(this.value, 's', { locale: this.getLocale().lowLevelValue });
  }

  getUnixSeconds(): number {
    return getUnixTime(this.value);
  }

  getUnixMilliseconds(): number {
    return this.value.getTime();
  }

  formatCalendarContext(): string {
    return format(this.value, 'LLLL yyyy', { locale: this.getLocale().lowLevelValue });
  }
}

/**
 * Date-fns implementation of DateTimeLibrary
 */
export class DateFnsDTL implements DateTimeLibrary<TZDate, Locale> {
  readonly timezoneNames = timezoneNames;
  private _offset: number = 0;

  get offset(): number {
    return this._offset;
  }

  updateOffset(offsetMs: number) {
    this._offset = offsetMs;
  }

  getLocaleNameFromLanguage(language: AvailableLanguage): string {
    const languageConfig = LANGUAGES[language];
    return this.getLocaleNameFromLanguageConfig(language, languageConfig);
  }

  getLocaleNameFromLanguageConfig(language: AvailableLanguage | undefined, languageConfig: LatestLanguageConfigType | undefined): string {
    return languageConfig?.dateFnsLocale ?? language ?? FALLBACK_LANGUAGE;
  }

  async loadLocaleLowLevel(localeName: string): Promise<Locale | undefined> {
    if (!(localeName in dateFnsLocaleMap)) {
      console.warn(`No date-fns locale loader found by key ${localeName}`);
      return;
    }

    try {
      return await dateFnsLocaleMap[localeName as keyof typeof dateFnsLocaleMap]().then((module) => module.default);
    } catch (e) {
      console.warn(`Failed to load date-fns locale ${localeName}`, e);
      return undefined;
    }
  }

  async localeLoader(localeName: string): Promise<DateTimeLibraryLocale<Locale>> {
    const locale = await this.loadLocaleLowLevel(localeName);

    return {
      name: localeName,
      lowLevelValue: locale,
      getShortWeekdays() {
        // Get day names for the locale - this is a simplified version
        // In a real implementation, you would use the proper locale data
        const dayNames = [];
        const baseDate = new Date(2021, 0, 3); // Sunday
        for (let i = 0; i < 7; i++) {
          const date = addDays(baseDate, i);
          dayNames.push(format(date, 'EEE', { locale }));
        }
        return dayNames;
      },
      getHourCycleInfo() {
        // Determine hour cycle based on locale
        // This is a simplified approach
        const is24HourLocale = ['hu', 'de', 'fr', 'es', 'it', 'pt-br'].includes(localeName.toLowerCase());
        return {
          hourCycle: is24HourLocale ? 'h24' : 'h12',
        };
      },
      getWeekInfo(): { firstDay: DateTimeLibraryWeekday; weekend: DateTimeLibraryWeekday[] } {
        // Get first day of week based on locale
        // Default to Sunday (0) if not available
        const firstDay = locale?.options?.weekStartsOn ?? 0;
        return {
          firstDay: firstDay as DateTimeLibraryWeekday,
          weekend: [DateTimeLibraryWeekday.Saturday, DateTimeLibraryWeekday.Sunday],
        };
      },
    };
  }

  guessInitialTimezoneName(): string {
    try {
      return Intl.DateTimeFormat().resolvedOptions().timeZone;
    } catch (e) {
      console.error('Could not determine initial timezone', e);
      // Return a default timezone if Intl API is not available
      return 'Etc/UTC';
    }
  }

  getDefaultInitialTimezoneSelection(hint?: string): TimezoneSelection {
    if (hint) {
      const offsetZoneMatch = hint.match(offsetZoneRegex);
      if (offsetZoneMatch !== null) {
        const hours = rangeLimit(parseInt(offsetZoneMatch[1], 10), -14, 14);
        const minutes = rangeLimit(parseInt(offsetZoneMatch[2], 10), 0, 59);
        if (!isNaN(hours)) {
          return {
            type: TimeZoneSelectionType.OFFSET,
            // Handle negative zero case consistently
            hours: hours === 0 ? 0 : hours,
            minutes: isNaN(minutes) ? 0 : minutes,
          };
        }
      } else {
        return { type: TimeZoneSelectionType.ZONE_NAME, name: hint };
      }
    }
    return { type: TimeZoneSelectionType.ZONE_NAME, name: this.guessInitialTimezoneName() };
  }

  getDefaultInitialDateTime(timezone: TimezoneSelection, defaultDateTime: string | undefined | null): [string, string] {
    const hasDefaultTs = typeof defaultDateTime === 'string';
    return this.getInitialDateTime(timezone, defaultDateTime, !hasDefaultTs);
  }

  getInitialDateTime(timezone: TimezoneSelection, defaultDateTime?: string | null, zeroSeconds?: boolean): [string, string] {
    if (typeof defaultDateTime === 'string') {
      let date = parse(defaultDateTime, urlFormat, this.applyOffsetToDate());
      if (zeroSeconds) {
        date = setSeconds(date, 0);
      }
      const dateString = format(date, isoFormattingDateFormat);
      const timeString = format(date, isoTimeFormat);
      return [dateString, timeString];
    }

    let tzDate: TZDate;
    switch (timezone.type) {
      case TimeZoneSelectionType.OFFSET: {
        const offsetString = getUtcOffsetString(timezone);
        // Create a virtual timezone name based on the offset
        const virtualTimezoneName = `Etc/GMT${offsetString.replace(':', '')}`;
        tzDate = new TZDate(this.applyOffsetToDate(), virtualTimezoneName);
        break;
      }
      case TimeZoneSelectionType.ZONE_NAME:
        tzDate = new TZDate(this.applyOffsetToDate(), timezone.name);
        break;
    }

    if (zeroSeconds) {
      tzDate = new TZDate(setSeconds(tzDate, 0), tzDate.timeZone);
    }

    const dateString = format(tzDate, isoFormattingDateFormat);
    const timeString = format(tzDate, isoTimeFormat);
    return [dateString, timeString];
  }

  getMeridiemLabel(isAm: boolean, minutes = 0, locale?: DateTimeLibraryLocale<Locale>): string {
    const time = new Date(2000, 0, 1, isAm ? 10 : 22, minutes);
    // Different locales handle AM/PM differently
    switch (locale?.name) {
      case 'hu':
        return isAm ? 'DE' : 'DU';
      default:
        return format(time, 'a', { locale: locale?.lowLevelValue }).toUpperCase();
    }
  }

  now() {
    const systemTimezone = this.guessInitialTimezoneName();
    return new DateFnsDTLValue(new TZDate(this.applyOffsetToDate(), systemTimezone), { library: this });
  }

  convertIsoToLocalizedDateTimeInputValue(date: string, time: string, locale: DateTimeLibraryLocale<Locale>): string {
    const dateTime = parse(`${date} ${time}`, isoFormat, this.applyOffsetToDate());
    const localeObj = locale.lowLevelValue;

    // Format strings to match expected outputs for each locale
    switch (locale.name) {
      case 'en':
        return format(dateTime, 'MMMM d, yyyy h:mm a', { locale: localeObj });
      case 'en-GB':
        return format(dateTime, 'd MMMM yyyy HH:mm', { locale: localeObj });
      case 'hu':
        return format(dateTime, 'yyyy. MMMM d. HH:mm', { locale: localeObj });
      default:
        return format(dateTime, 'PPpp', { locale: localeObj });
    }
  }

  convertIsoToLocalizedDateInputValue(date: string, locale: DateTimeLibraryLocale<Locale>): string {
    const dateObj = parse(date, isoParsingDateFormat, this.applyOffsetToDate());
    const localeObj = locale.lowLevelValue;

    // Format strings to match expected outputs for each locale
    switch (locale.name) {
      case 'en':
        return format(dateObj, 'MMMM d, yyyy', { locale: localeObj });
      case 'en-GB':
        return format(dateObj, 'd MMMM yyyy', { locale: localeObj });
      case 'hu':
        return format(dateObj, 'yyyy. MMMM d.', { locale: localeObj });
      default:
        return format(dateObj, 'PP', { locale: localeObj });
    }
  }

  convertIsoToLocalizedTimeInputValue(time: string, locale: DateTimeLibraryLocale<Locale>): string {
    const baseDate = new Date(1970, 0, 1);
    const timeObj = parse(time, isoTimeFormat, baseDate);

    const value = this.fromIsoString(timeObj.toISOString());
    return value.setLocale(locale).formatDiscordTimestamp(MessageTimestampFormat.LONG_TIME);
  }

  getValueForIsoZonedDate(date: string, timezone: TimezoneSelection): DateTimeLibraryValue<TZDate> {
    return this.getValueForIsoZonedDateTime(date, defaultTime, timezone);
  }

  getValueForIsoZonedTime(time: string, timezone: TimezoneSelection): DateTimeLibraryValue<TZDate> {
    return this.getValueForIsoZonedDateTime(defaultDate, time, timezone);
  }

  getValueForIsoZonedDateTime(date: string, time: string, timezone: TimezoneSelection): DateTimeLibraryValue<TZDate> {
    const inputString = `${date} ${time}`;

    switch (timezone.type) {
      case TimeZoneSelectionType.OFFSET: {
        const parsedDate = parse(inputString, isoFormat, new TZDate(this.applyOffsetToDate(), getUtcOffsetString(timezone)));
        return new DateFnsDTLValue(parsedDate, { library: this });
      }
      case TimeZoneSelectionType.ZONE_NAME: {
        const parsedDate = parse(inputString, isoFormat, new TZDate(this.applyOffsetToDate(), timezone.name));
        return new DateFnsDTLValue(parsedDate, { library: this });
      }
    }
  }

  getValueForDate(year: number, month: number, date: number): DateTimeLibraryValue<TZDate> {
    const systemTimezone = this.guessInitialTimezoneName();
    return new DateFnsDTLValue(new TZDate(new Date(year, month, date, 0, 0, 0, 0), systemTimezone), { library: this });
  }

  fromIsoString(iso: string): DateTimeLibraryValue<TZDate> {
    const systemTimezone = this.guessInitialTimezoneName();
    return new DateFnsDTLValue(new TZDate(new Date(iso), systemTimezone), { library: this });
  }

  fromTimestampMsUtc(timestamp: number): DateTimeLibraryValue<TZDate> {
    const utcDate = new Date(timestamp);
    // Create TZDate with explicit UTC timezone
    return new DateFnsDTLValue(new TZDate(utcDate, 'Etc/UTC'), { library: this });
  }

  private applyOffsetToDate<T extends Date>(date: T = new Date() as T): T {
    date.setTime(date.getTime() + this.offset);
    return date;
  }
}
