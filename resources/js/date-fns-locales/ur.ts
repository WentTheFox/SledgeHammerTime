/**
 * Urdu (Pakistan) locale for date-fns, which does not ship one.
 *
 * Structure follows the locales bundled with date-fns (see e.g. date-fns/locale/fa-IR). The small `_lib` builder
 * helpers of date-fns are not part of its public exports, so minimal equivalents are defined at the bottom of this file.
 *
 * Month and weekday names are standard Urdu; the relative-time phrases have not been reviewed by a native speaker.
 */
import type { Locale } from 'date-fns';

// region formatDistance
type DistanceTokenValue = string | { one: string; other: string };

const formatDistanceLocale: Record<string, DistanceTokenValue> = {
  lessThanXSeconds: { one: 'ایک سیکنڈ سے کم', other: '{{count}} سیکنڈ سے کم' },
  xSeconds: { one: '1 سیکنڈ', other: '{{count}} سیکنڈ' },
  halfAMinute: 'آدھا منٹ',
  lessThanXMinutes: { one: 'ایک منٹ سے کم', other: '{{count}} منٹ سے کم' },
  xMinutes: { one: '1 منٹ', other: '{{count}} منٹ' },
  aboutXHours: { one: 'تقریباً 1 گھنٹہ', other: 'تقریباً {{count}} گھنٹے' },
  xHours: { one: '1 گھنٹہ', other: '{{count}} گھنٹے' },
  xDays: { one: '1 دن', other: '{{count}} دن' },
  aboutXWeeks: { one: 'تقریباً 1 ہفتہ', other: 'تقریباً {{count}} ہفتے' },
  xWeeks: { one: '1 ہفتہ', other: '{{count}} ہفتے' },
  aboutXMonths: { one: 'تقریباً 1 مہینہ', other: 'تقریباً {{count}} مہینے' },
  xMonths: { one: '1 مہینہ', other: '{{count}} مہینے' },
  aboutXYears: { one: 'تقریباً 1 سال', other: 'تقریباً {{count}} سال' },
  xYears: { one: '1 سال', other: '{{count}} سال' },
  overXYears: { one: '1 سال سے زیادہ', other: '{{count}} سال سے زیادہ' },
  almostXYears: { one: 'تقریباً 1 سال', other: 'تقریباً {{count}} سال' },
};

const formatDistance: Locale['formatDistance'] = (token, count, options) => {
  let result: string;
  const tokenValue = formatDistanceLocale[token];
  if (typeof tokenValue === 'string') {
    result = tokenValue;
  } else if (count === 1) {
    result = tokenValue.one;
  } else {
    result = tokenValue.other.replace('{{count}}', String(count));
  }

  if (options?.addSuffix) {
    return options.comparison && options.comparison > 0
      ? `${result} میں`
      : `${result} پہلے`;
  }
  return result;
};
// endregion

// region formatLong
const dateFormats = {
  full: 'EEEE، d MMMM y',
  long: 'd MMMM y',
  medium: 'd MMM y',
  short: 'dd/MM/y',
};

const timeFormats = {
  full: 'h:mm:ss a zzzz',
  long: 'h:mm:ss a z',
  medium: 'h:mm:ss a',
  short: 'h:mm a',
};

const dateTimeFormats = {
  full: '{{date}} \'بوقت\' {{time}}',
  long: '{{date}} \'بوقت\' {{time}}',
  medium: '{{date}}، {{time}}',
  short: '{{date}}، {{time}}',
};

const buildFormatLongFn = (formats: Record<string, string>, defaultWidth: string) =>
  (options: { width?: string } = {}) => formats[options.width ?? defaultWidth] ?? formats[defaultWidth];

const formatLong: Locale['formatLong'] = {
  date: buildFormatLongFn(dateFormats, 'full'),
  time: buildFormatLongFn(timeFormats, 'full'),
  dateTime: buildFormatLongFn(dateTimeFormats, 'full'),
};
// endregion

// region formatRelative
const formatRelativeLocale: Record<string, string> = {
  lastWeek: '\'گزشتہ\' eeee \'کو\' p',
  yesterday: '\'گزشتہ کل\' p',
  today: '\'آج\' p',
  tomorrow: '\'آنے والے کل\' p',
  nextWeek: '\'آئندہ\' eeee \'کو\' p',
  other: 'P',
};

const formatRelative: Locale['formatRelative'] = (token) => formatRelativeLocale[token];
// endregion

// region localize
type WidthValues<T> = { narrow: T; abbreviated: T; wide: T };

const eraValues: WidthValues<string[]> = {
  narrow: ['ق م', 'ع'],
  abbreviated: ['ق م', 'عیسوی'],
  wide: ['قبل مسیح', 'عیسوی'],
};

const quarterValues: WidthValues<string[]> = {
  narrow: ['1', '2', '3', '4'],
  abbreviated: ['سہ ماہی 1', 'سہ ماہی 2', 'سہ ماہی 3', 'سہ ماہی 4'],
  wide: ['پہلی سہ ماہی', 'دوسری سہ ماہی', 'تیسری سہ ماہی', 'چوتھی سہ ماہی'],
};

const monthNames = [
  'جنوری', 'فروری', 'مارچ', 'اپریل', 'مئی', 'جون',
  'جولائی', 'اگست', 'ستمبر', 'اکتوبر', 'نومبر', 'دسمبر',
];

const monthValues: WidthValues<string[]> = {
  narrow: ['ج', 'ف', 'م', 'ا', 'م', 'ج', 'ج', 'ا', 'س', 'ا', 'ن', 'د'],
  abbreviated: monthNames,
  wide: monthNames,
};

const dayNames = ['اتوار', 'پیر', 'منگل', 'بدھ', 'جمعرات', 'جمعہ', 'ہفتہ'];

const dayValues: WidthValues<string[]> & { short: string[] } = {
  narrow: ['ا', 'پ', 'م', 'ب', 'ج', 'ج', 'ہ'],
  short: dayNames,
  abbreviated: dayNames,
  wide: dayNames,
};

const dayPeriodWide = {
  am: 'صبح',
  pm: 'شام',
  midnight: 'آدھی رات',
  noon: 'دوپہر',
  morning: 'صبح',
  afternoon: 'دوپہر',
  evening: 'شام',
  night: 'رات',
};

const dayPeriodValues: WidthValues<typeof dayPeriodWide> = {
  narrow: dayPeriodWide,
  abbreviated: dayPeriodWide,
  wide: dayPeriodWide,
};

type LocalizeContext = { context?: string; width?: string };

const buildLocalizeFn = (
  values: Record<string, unknown>,
  defaultWidth: string,
  argumentCallback?: (value: number) => number,
) => (value: number | string, options?: LocalizeContext) => {
  const width = options?.width && values[options.width] ? options.width : defaultWidth;
  const valuesArray = values[width] as Record<string | number, string>;
  const index = argumentCallback ? argumentCallback(value as number) : value;
  return valuesArray[index];
};

const localize = {
  ordinalNumber: (dirtyNumber: number) => String(dirtyNumber),
  era: buildLocalizeFn(eraValues, 'wide'),
  quarter: buildLocalizeFn(quarterValues, 'wide', (quarter) => quarter - 1),
  month: buildLocalizeFn(monthValues, 'wide'),
  day: buildLocalizeFn(dayValues, 'wide'),
  dayPeriod: buildLocalizeFn(dayPeriodValues, 'wide'),
} as unknown as Locale['localize'];
// endregion

// region match
type MatchResult<T> = { value: T; rest: string } | null;

const buildMatchFn = (
  matchPatterns: Record<string, RegExp>,
  defaultMatchWidth: string,
  parsePatterns: Record<string, RegExp[]>,
  defaultParseWidth: string,
  valueCallback?: (index: number) => number,
) => (string: string, options: { width?: string } = {}): MatchResult<number> => {
  const matchPattern = (options.width && matchPatterns[options.width]) || matchPatterns[defaultMatchWidth];
  const matchResult = string.match(matchPattern);
  if (!matchResult) return null;

  const matchedString = matchResult[0];
  const patterns = (options.width && parsePatterns[options.width]) || parsePatterns[defaultParseWidth];
  const index = patterns.findIndex((pattern) => pattern.test(matchedString));
  if (index === -1) return null;

  return {
    value: valueCallback ? valueCallback(index) : index,
    rest: string.slice(matchedString.length),
  };
};

const matchOrdinalNumber = (string: string): MatchResult<number> => {
  const matchResult = string.match(/^\d+/);
  if (!matchResult) return null;
  return { value: parseInt(matchResult[0], 10), rest: string.slice(matchResult[0].length) };
};

const monthPatterns = monthNames.map((name) => new RegExp(`^${name}`));
const dayPatterns = dayNames.map((name) => new RegExp(`^${name}`));

const match = {
  ordinalNumber: matchOrdinalNumber,
  era: buildMatchFn(
    { narrow: /^(ق م|ع)/, abbreviated: /^(ق م|عیسوی)/, wide: /^(قبل مسیح|عیسوی)/ },
    'wide',
    { any: [/^ق/, /^ع/] },
    'any',
  ),
  quarter: buildMatchFn(
    { narrow: /^[1234]/, abbreviated: /^سہ ماہی [1234]/, wide: /^(پہلی|دوسری|تیسری|چوتھی) سہ ماہی/ },
    'wide',
    { any: [/1|پہلی/, /2|دوسری/, /3|تیسری/, /4|چوتھی/] },
    'any',
    (index) => index + 1,
  ),
  month: buildMatchFn(
    { narrow: /^[جفماسند]/, abbreviated: new RegExp(`^(${monthNames.join('|')})`), wide: new RegExp(`^(${monthNames.join('|')})`) },
    'wide',
    { narrow: monthPatterns, any: monthPatterns },
    'any',
  ),
  day: buildMatchFn(
    { narrow: /^[اپمبجہ]/, short: new RegExp(`^(${dayNames.join('|')})`), abbreviated: new RegExp(`^(${dayNames.join('|')})`), wide: new RegExp(`^(${dayNames.join('|')})`) },
    'wide',
    { narrow: dayPatterns, any: dayPatterns },
    'any',
  ),
  dayPeriod: (string: string): MatchResult<string> => {
    const periods: Array<[string, string]> = [
      ['am', 'صبح'], ['pm', 'شام'], ['midnight', 'آدھی رات'], ['noon', 'دوپہر'],
      ['morning', 'صبح'], ['afternoon', 'دوپہر'], ['evening', 'شام'], ['night', 'رات'],
    ];
    const found = periods.find(([, name]) => string.startsWith(name));
    return found ? { value: found[0], rest: string.slice(found[1].length) } : null;
  },
} as unknown as Locale['match'];
// endregion

export const ur: Locale = {
  code: 'ur',
  formatDistance,
  formatLong,
  formatRelative,
  localize,
  match,
  options: {
    weekStartsOn: 1 /* Monday */,
    firstWeekContainsDate: 1,
  },
};

export default ur;
