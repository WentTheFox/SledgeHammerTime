import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryLocale, HourCycle } from '@/classes/DateTimeLibraryLocale';
import {
  CalendarContext,
  DateTimeLibraryValue,
  DateTimeLibraryWeekday,
} from '@/classes/DateTimeLibraryValue';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import { TimezoneSelection, TimeZoneSelectionType } from '@/model/timezone-selection';
import { WeekdayItem } from '@/utils/calendar';
import {
  AvailableLanguage,
  FALLBACK_LANGUAGE,
  LANGUAGES,
  LatestLanguageConfigType,
} from '@/utils/language-settings';
import { getUtcOffsetString, offsetZoneRegex, rangeLimit } from '@/utils/time';
import { TZDate } from '@date-fns/tz';
import {
  addDays,
  addMilliseconds,
  addMonths,
  addYears,
  format,
  formatDistanceToNowStrict,
  getDaysInMonth,
  getUnixTime,
  isPast,
  isValid,
  Locale,
  parse,
  setHours,
  setMinutes,
  setSeconds,
  subYears,
} from 'date-fns';
import { enUS } from 'date-fns/locale/en-US';

// Locale cache — pre-seeded with the fallback locale so loadLocaleLowLevel is always synchronous.
// Populated on-demand via preloadDateFnsLocale before rendering starts.
const localeCache = new Map<string, Locale>([['enUS', enUS]]);

const localeImports: Record<string, () => Promise<Locale>> = {
  ar:   () => import('date-fns/locale/ar').then(m => m.ar),
  bg:   () => import('date-fns/locale/bg').then(m => m.bg),
  ca:   () => import('date-fns/locale/ca').then(m => m.ca),
  zhCN: () => import('date-fns/locale/zh-CN').then(m => m.zhCN),
  zhTW: () => import('date-fns/locale/zh-TW').then(m => m.zhTW),
  hr:   () => import('date-fns/locale/hr').then(m => m.hr),
  cs:   () => import('date-fns/locale/cs').then(m => m.cs),
  da:   () => import('date-fns/locale/da').then(m => m.da),
  nl:   () => import('date-fns/locale/nl').then(m => m.nl),
  enGB: () => import('date-fns/locale/en-GB').then(m => m.enGB),
  enUS: () => import('date-fns/locale/en-US').then(m => m.enUS),
  eo:   () => import('date-fns/locale/eo').then(m => m.eo),
  fi:   () => import('date-fns/locale/fi').then(m => m.fi),
  fr:   () => import('date-fns/locale/fr').then(m => m.fr),
  de:   () => import('date-fns/locale/de').then(m => m.de),
  el:   () => import('date-fns/locale/el').then(m => m.el),
  hi:   () => import('date-fns/locale/hi').then(m => m.hi),
  he:   () => import('date-fns/locale/he').then(m => m.he),
  hu:   () => import('date-fns/locale/hu').then(m => m.hu),
  id:   () => import('date-fns/locale/id').then(m => m.id),
  it:   () => import('date-fns/locale/it').then(m => m.it),
  ja:   () => import('date-fns/locale/ja').then(m => m.ja),
  ko:   () => import('date-fns/locale/ko').then(m => m.ko),
  lv:   () => import('date-fns/locale/lv').then(m => m.lv),
  lt:   () => import('date-fns/locale/lt').then(m => m.lt),
  ms:   () => import('date-fns/locale/ms').then(m => m.ms),
  mn:   () => import('date-fns/locale/mn').then(m => m.mn),
  nb:   () => import('date-fns/locale/nb').then(m => m.nb),
  fa:   () => import('date-fns/locale/fa-IR').then(m => m.faIR),
  pl:   () => import('date-fns/locale/pl').then(m => m.pl),
  pt:   () => import('date-fns/locale/pt').then(m => m.pt),
  ptBR: () => import('date-fns/locale/pt-BR').then(m => m.ptBR),
  ro:   () => import('date-fns/locale/ro').then(m => m.ro),
  ru:   () => import('date-fns/locale/ru').then(m => m.ru),
  sr:   () => import('date-fns/locale/sr').then(m => m.sr),
  es:   () => import('date-fns/locale/es').then(m => m.es),
  sv:   () => import('date-fns/locale/sv').then(m => m.sv),
  th:   () => import('date-fns/locale/th').then(m => m.th),
  tr:   () => import('date-fns/locale/tr').then(m => m.tr),
  uk:   () => import('date-fns/locale/uk').then(m => m.uk),
  vi:   () => import('date-fns/locale/vi').then(m => m.vi),
};

export const preloadDateFnsLocale = async (normalizedName: string): Promise<void> => {
  if (localeCache.has(normalizedName)) return;
  const importer = localeImports[normalizedName];
  if (!importer) return;
  localeCache.set(normalizedName, await importer());
};

export const getDateFnsNormalizedLocaleName = (locale: string): string => {
  // Laravel locales use underscores (en_GB); LANGUAGES keys use hyphens (en-GB). Normalize first.
  const bcp47 = locale.replace(/_/g, '-');
  const lang = (bcp47 in LANGUAGES) ? bcp47 as AvailableLanguage : FALLBACK_LANGUAGE;
  return (LANGUAGES[lang]?.dateFnsLocale ?? lang).replace(/[^a-z\d]/gi, '');
};

// Format constants
const isoTimeFormat = 'HH:mm:ss';
const isoFormattingDateFormat = 'yyyy-MM-dd';
const isoParsingDateFormat = 'yyyy-MM-dd';
const isoFormat = `${isoFormattingDateFormat} ${isoTimeFormat}`;
const oneMinuteInSecondsMs = 1e3 * 60;
const alreadyLoggedMissingLocaleNames = new Set<string>();

// Default values
const defaultDate = '2023-01-01';
const defaultTime = '00:00:00';

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
    case MessageTimestampFormat.SHORT_COMPACT:
      return `${getDiscordToUnicodeFormat(MessageTimestampFormat.SHORT_DATE, language)} ${getDiscordToUnicodeFormat(MessageTimestampFormat.SHORT_TIME, language)}`;
    case MessageTimestampFormat.LONG_COMPACT:
      return `${getDiscordToUnicodeFormat(MessageTimestampFormat.SHORT_DATE, language)} ${getDiscordToUnicodeFormat(MessageTimestampFormat.LONG_TIME, language)}`;
    default:
      throw new Error(`Unsupported format: ${format}`);
  }
};

/**
 * Implementation of DateTimeLibraryValue using date-fns
 */
class DateFnsDTLValue extends DateTimeLibraryValue<TZDate, Locale> {
  get value(): TZDate {
    return new TZDate(this.rawValue, this.rawValue.timeZone);
  }

  set value(value: TZDate) {
    const valueCopy = new TZDate(value, value.timeZone);
    valueCopy.setTime(value.getTime());
    this.rawValue = value;
  }

  toString(): string {
    return `[object DateFnsDTLValue(${this.toISOString()})}]`;
  }

  setLocale(locale: DateTimeLibraryLocale<Locale>) {
    const localeLow = locale.lowLevelValue;
    if (!localeLow || !('formatLong' in localeLow)) {
      console.error('[DateFnsDTLValue#setLocale] incomplete locale definition:', localeLow);
      throw new Error('Incomplete locale definition provided');
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
    if (!isValid(this.value)) return '';
    return formatDistanceToNowStrict(this.value, {
      locale: this.getLocale().lowLevelValue,
      addSuffix: true,
    });
  }

  addMilliseconds(days: number) {
    return new DateFnsDTLValue(addMilliseconds(this.value, days), this.context);
  }

  addDays(days: number) {
    return new DateFnsDTLValue(addDays(this.value, days), this.context);
  }

  addMonths(months: number) {
    return new DateFnsDTLValue(addMonths(this.value, months), this.context);
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

  getIsPast(): boolean {
    return isPast(this.value);
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
    if (!isValid(this.value)) return '';
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
    if (!isValid(this.value)) return '';
    return format(this.value, getDiscordToUnicodeFormat(mtf, locale.name), { locale: locale.lowLevelValue });
  }

  daysInMonth(): number {
    return getDaysInMonth(this.value);
  }

  formatCalendarDateDisplay(): string {
    return format(this.value, 'd', { locale: this.getLocale().lowLevelValue });
  }

  formatCalendarMonthDisplay(): string {
    return format(this.value, 'LLL', { locale: this.getLocale().lowLevelValue });
  }

  formatCalendarYearDisplay(): string {
    return format(this.value, 'yyyy', { locale: this.getLocale().lowLevelValue });
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

  formatCalendarContext(currentContext: CalendarContext, short: boolean): string[] {
    switch (currentContext) {
      case CalendarContext.DATE:
        return [
          format(this.value, `${short ? 'LLL' : 'LLLL'} yyyy`, { locale: this.getLocale().lowLevelValue }),
        ];
      case CalendarContext.MONTH:
        if (short) return [];
        return [
          format(this.value, `yyyy`, { locale: this.getLocale().lowLevelValue }),
        ];
      case CalendarContext.DECADE: {
        if (short) return [];
        const nearestDecadeStart = subYears(this.value, this.value.getFullYear() % 10);
        const nearestDecadeEnd = addYears(nearestDecadeStart, 9);
        return [
          format(nearestDecadeStart, `yyyy`, { locale: this.getLocale().lowLevelValue }),
          format(nearestDecadeEnd, `yyyy`, { locale: this.getLocale().lowLevelValue }),
        ];
      }
    }
  }
}

/**
 * Date-fns implementation of DateTimeLibrary
 */
export class DateFnsDTL implements DateTimeLibrary<TZDate, Locale> {
  readonly timezoneNames = timezoneNames;

  getMinimumOffsetMs(): number {
    return oneMinuteInSecondsMs * 5;
  }

  getLocaleNameFromLanguage(language: AvailableLanguage): string {
    const languageConfig = LANGUAGES[language];
    return this.getLocaleNameFromLanguageConfig(language, languageConfig);
  }

  getLocaleNameFromLanguageConfig(language: AvailableLanguage | undefined, languageConfig: LatestLanguageConfigType | undefined): string {
    return languageConfig?.dateFnsLocale ?? language ?? FALLBACK_LANGUAGE;
  }

  loadLocaleLowLevel(localeName: string): Locale | undefined {
    const normalizedLocaleName = localeName.replace(/[^a-z\d]/gi, '');
    let locale: Locale | undefined = localeCache.get(normalizedLocaleName);
    if (typeof locale === 'undefined') {
      if (!alreadyLoggedMissingLocaleNames.has(localeName)) {
        console.warn(`No date-fns locale found by key ${normalizedLocaleName}`);
        alreadyLoggedMissingLocaleNames.add(localeName);
      }
      // Load English as a fallback when locale is unavailable for date-fns
      locale = enUS;
    }

    return locale;
  }

  private uses24HourClock(locale: Locale | undefined) {
    if (!locale) return true;

    const timeFormat = locale.formatLong.time({});
    return /H/.test(timeFormat);
  }

  localeLoader(localeName: string): DateTimeLibraryLocale<Locale> {
    const locale = this.loadLocaleLowLevel(localeName);

    const getFirstDay = (): DateTimeLibraryWeekday => {
      switch (localeName) {
        case 'ms':
          return DateTimeLibraryWeekday.Sunday;

        default:
          // Get the first day of week based on locale
          // Default to Sunday (0) if not available
          return (locale?.options?.weekStartsOn ?? DateTimeLibraryWeekday.Sunday) as DateTimeLibraryWeekday;
      }
    };

    return {
      name: localeName,
      lowLevelValue: locale,
      getWeekdays(short = false) {
        const weekdays: WeekdayItem[] = [];
        const baseDate = new Date(2021, 0, 3); // Sunday
        for (let i = 0; i < 7; i++) {
          const date = addDays(baseDate, i);
          weekdays.push({
            index: i as DateTimeLibraryWeekday,
            name: format(date, short ? 'EEEEEE' : 'EEEE', { locale }),
          });
        }
        return weekdays;
      },
      getHourCycleInfo: () => {
        // Determine hour cycle based on locale
        // This is a simplified approach
        return {
          hourCycle: this.uses24HourClock(locale) ? HourCycle.H24 : HourCycle.H12,
        };
      },
      getWeekInfo() {
        return {
          firstDay: getFirstDay(),
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

  getDefaultInitialTimezoneSelection(hint?: string): TimezoneSelection | undefined {
    if (hint) {
      if (hint === 'Etc/GMT') {
        return {
          type: TimeZoneSelectionType.ZONE_NAME,
          name: 'Etc/UTC',
        };
      }
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

  getDefaultInitialDateTime(timezone: TimezoneSelection, defaultUnixTimestamp: string | undefined | null): [string, string] {
    const hasDefaultTs = typeof defaultUnixTimestamp === 'string';
    return this.getInitialDateTime(timezone, defaultUnixTimestamp, !hasDefaultTs);
  }

  getInitialDateTime(timezone: TimezoneSelection, defaultUnixTimestamp?: string | null, zeroSeconds?: boolean): [string, string] {
    const initialTs = typeof defaultUnixTimestamp === 'string' ? parseInt(defaultUnixTimestamp, 10) * 1000 : new Date().getTime();

    let tzDate = new TZDate(1970, 0, 1, 0, 0, 0, 'UTC');
    switch (timezone.type) {
      case TimeZoneSelectionType.OFFSET: {
        const offsetString = getUtcOffsetString(timezone);
        tzDate = new TZDate(initialTs, offsetString);
        break;
      }
      case TimeZoneSelectionType.ZONE_NAME:
        tzDate = new TZDate(initialTs, timezone.name);
        break;
    }

    if (zeroSeconds) {
      tzDate = setSeconds(tzDate, 0);
    }

    const dateString = format(tzDate, isoFormattingDateFormat);
    const timeString = format(tzDate, isoTimeFormat);
    return [dateString, timeString];
  }

  getMeridiemLabel(isAm: boolean, locale: DateTimeLibraryLocale<Locale> | undefined | null, minutes?: number): string {
    const time = new Date(2000, 0, 1, isAm ? 10 : 22, minutes);
    return format(time, 'a', { locale: locale?.lowLevelValue }).toUpperCase();
  }

  now(): DateTimeLibraryValue<TZDate> {
    const systemTimezone = this.guessInitialTimezoneName();
    return this.nowInZone(systemTimezone);
  }

  nowInZone(timezone: string): DateTimeLibraryValue<TZDate> {
    return new DateFnsDTLValue(new TZDate(new Date(), timezone), { library: this });
  }

  convertIsoToLocalizedDateTimeInputValue(date: string, time: string, locale: DateTimeLibraryLocale<Locale>): string {
    const dateTime = parse(`${date} ${time}`, isoFormat, new Date());
    const localeObj = locale.lowLevelValue;

    // Format strings to match expected outputs for each locale
    switch (locale.name) {
      case 'en-US':
        return format(dateTime, 'MMMM d, yyyy h:mm:ss a', { locale: localeObj });
      case 'en-GB':
        return format(dateTime, 'd MMMM yyyy HH:mm:ss', { locale: localeObj });
      case 'hu':
        return format(dateTime, 'yyyy. MMMM d. HH:mm:ss', { locale: localeObj });
      default:
        return format(dateTime, 'PPpp', { locale: localeObj });
    }
  }

  convertIsoToLocalizedDateInputValue(date: string, locale: DateTimeLibraryLocale<Locale>): string {
    const dateObj = parse(date, isoParsingDateFormat, new Date());
    const localeObj = locale.lowLevelValue;

    // Format strings to match expected outputs for each locale
    switch (locale.name) {
      case 'en-US':
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
        const parsedDate = parse(inputString, isoFormat, new TZDate(new Date(), getUtcOffsetString(timezone)));
        return new DateFnsDTLValue(parsedDate, { library: this });
      }
      case TimeZoneSelectionType.ZONE_NAME: {
        const parsedDate = parse(inputString, isoFormat, new TZDate(new Date(), timezone.name));
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
}
