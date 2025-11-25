import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { TimezoneSelection } from '@/model/timezone-selection';
import { AvailableLanguage, LatestLanguageConfigType } from '@/utils/language-settings';

// eslint-disable-next-line @typescript-eslint/no-explicit-any -- Needed for testing
export interface DateTimeLibrary<T = any, L = any> {
  readonly timezoneNames: string[];

  get offset(): number;

  getMinimumOffsetMs(): number;

  updateOffset(offsetMs: number): void;

  getLocaleNameFromLanguage(language: AvailableLanguage): string;

  getLocaleNameFromLanguageConfig(language: AvailableLanguage | undefined, languageConfig: LatestLanguageConfigType | undefined): string;

  loadLocaleLowLevel(localeName: string): L | undefined;

  localeLoader(localeName: string): DateTimeLibraryLocale<L>;

  guessInitialTimezoneName(): string;

  getDefaultInitialTimezoneSelection(hint?: string): TimezoneSelection | undefined;

  getMeridiemLabel(isAm: boolean, minutes?: number, locale?: DateTimeLibraryLocale<L>): string;

  getDefaultInitialDateTime(
    timezone: TimezoneSelection,
    defaultUnixTimestamp: string | undefined | null,
  ): [string, string];

  getInitialDateTime(
    timezone: TimezoneSelection,
    defaultUnixTimestamp?: string | null,
    zeroSeconds?: boolean,
  ): [string, string];

  now(): DateTimeLibraryValue<T, L>;

  nowInZone(timezone: string): DateTimeLibraryValue<T, L>;

  convertIsoToLocalizedDateTimeInputValue(
    date: string,
    time: string,
    locale: DateTimeLibraryLocale<L>,
  ): string;

  convertIsoToLocalizedDateInputValue(
    date: string,
    locale: DateTimeLibraryLocale<L>,
  ): string;

  convertIsoToLocalizedTimeInputValue(
    time: string,
    locale: DateTimeLibraryLocale<L>,
  ): string;

  getValueForIsoZonedDate(
    date: string,
    timezone: TimezoneSelection,
  ): DateTimeLibraryValue<T, L>;

  getValueForIsoZonedTime(
    time: string,
    timezone: TimezoneSelection,
  ): DateTimeLibraryValue<T, L>;

  getValueForIsoZonedDateTime(
    date: string,
    time: string,
    timezone: TimezoneSelection,
  ): DateTimeLibraryValue<T, L>;

  /**
   * Months are 0-indexed
   */
  getValueForDate(year: number, month: number, date: number): DateTimeLibraryValue<T, L>;

  fromIsoString(iso: string): DateTimeLibraryValue<T, L>;

  fromTimestampMsUtc(number: number): DateTimeLibraryValue<T, L>;
}


export type LocaleLoader = DateTimeLibrary['localeLoader'];
