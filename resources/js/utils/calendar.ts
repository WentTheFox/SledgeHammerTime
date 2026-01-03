import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import {
  DateTimeLibraryMonth,
  DateTimeLibraryValue,
  DateTimeLibraryWeekday,
} from '@/classes/DateTimeLibraryValue';
import { DeepReadonly } from 'vue';

interface BaseGenerateCalendarOptions {
  dtl: DeepReadonly<DateTimeLibrary> | undefined;
  locale: DateTimeLibraryLocale | null;
}

export interface GenerateCalendarMonthOptions extends BaseGenerateCalendarOptions {
  year: number;
  month: DateTimeLibraryMonth | number;
  firstDayOfWeek?: DateTimeLibraryWeekday;
}

export interface GenerateCalendarYearOptions extends BaseGenerateCalendarOptions {
  year: number;
}

export interface GenerateCalendarDecadeOptions extends BaseGenerateCalendarOptions {
  year: number;
}

export interface CalendarMonthDay {
  date: number;
  month: number;
  year: number;
  display: string;
  /**
   * Optional metadata used for display purposes only
   */
  weekday?: DateTimeLibraryWeekday;
}

export interface CalendarMonth {
  // 2D array of [week][weekday]
  weeks: CalendarMonthDay[][];
  firstDayOfWeek: DateTimeLibraryWeekday | number;
}

export interface CalendarYearMonth {
  month: number;
  year: number;
  display: string;
}

export interface CalendarYear {
  // 2D array of [quarter][month]
  months: CalendarYearMonth[][];
}

export interface CalendarDecadeYear {
  year: number;
  display: string;
}

export interface CalendarDecade {
  // 2D array of [row][column]
  rows: CalendarDecadeYear[][];
}

type WeekendDays = Partial<Record<DateTimeLibraryWeekday, string>>;

const redSundayWeekendDays: WeekendDays = {
  [DateTimeLibraryWeekday.Sunday]: 'red',
};
const redSaturdayWeekendDays: WeekendDays = {
  [DateTimeLibraryWeekday.Saturday]: 'red',
};
const redSaturdayAndSundayWeekendDays = { ...redSaturdayWeekendDays, ...redSundayWeekendDays };

export const WEEKEND_DAYS: Partial<Record<string, WeekendDays>> = {
  hr: redSundayWeekendDays,
  nl: { ...redSaturdayWeekendDays, ...redSundayWeekendDays },
  he: {
    ...redSaturdayWeekendDays,
    [DateTimeLibraryWeekday.Friday]: 'red',
  },
  hu: redSaturdayAndSundayWeekendDays,
  it: redSaturdayAndSundayWeekendDays,
  ms: {
    ...redSundayWeekendDays,
    [DateTimeLibraryWeekday.Saturday]: 'blue',
  },
  pl: redSundayWeekendDays,
  sr: redSundayWeekendDays,
  sv: redSundayWeekendDays,
};

export const LENGTH_OF_WEEK = 7;
const FIRST_MONTH_OF_YEAR = DateTimeLibraryMonth.January;
const FIRST_DAY_OF_MONTH = 1;

/**
 * Convert a JS-based weekday to a human-readable value
 */
const normalizeWeekday = (weekday: DateTimeLibraryWeekday | number): number => {
  if (weekday > 6) throw new Error('Weekday must be a valid JS weekday');
  if (weekday === 0) return 7;
  return weekday;
};

export const getFirstDayOfWeekOffset = (firstDayOfMonthDateTime: DateTimeLibraryValue, firstDayOfWeek: DateTimeLibraryWeekday | number): number => {
  const firstDayWeekday = firstDayOfMonthDateTime.getWeekday();
  if (firstDayWeekday === firstDayOfWeek) {
    return 0;
  }
  const firstDayWeekdayNormalized = normalizeWeekday(firstDayWeekday);
  const firstDayOfWeekNormalized = normalizeWeekday(firstDayOfWeek);
  const offset = firstDayWeekdayNormalized < firstDayOfWeekNormalized ? LENGTH_OF_WEEK : 0;
  return firstDayOfWeekNormalized - firstDayWeekdayNormalized - offset;
};

export const getCalendarRows = (firstDayOfMonthDateTime: DateTimeLibraryValue, firstDayOfWeekOffset: number) => {
  const daysInMonth = firstDayOfMonthDateTime.daysInMonth();
  return Math.ceil((daysInMonth + Math.abs(firstDayOfWeekOffset)) / LENGTH_OF_WEEK);
};

export interface WeekdayItem {
  index: DateTimeLibraryWeekday;
  name: string;
}

export const getWeekdayItems = (weekdays: string[] | undefined, firstDayOfWeek: DateTimeLibraryWeekday): WeekdayItem[] => {
  if (!weekdays) {
    return [];
  }

  const items = weekdays.map((weekday, index) => ({
    index,
    name: weekday,
  }));

  if (firstDayOfWeek === DateTimeLibraryWeekday.Sunday) {
    return items;
  }

  return items.slice(firstDayOfWeek).concat(items.slice(0, firstDayOfWeek));
};

export const generateCalendarMonth = ({
  dtl,
  locale,
  year,
  month,
  firstDayOfWeek = DateTimeLibraryWeekday.Monday,
}: GenerateCalendarMonthOptions): CalendarMonth => {
  if (!dtl || !locale) {
    return {
      weeks: [],
      firstDayOfWeek,
    };
  }

  if (month < DateTimeLibraryMonth.January || month > DateTimeLibraryMonth.December) {
    throw new Error('Month is out of bounds');
  }
  const firstDayOfMonthDateTime = dtl.getValueForDate(year, month, FIRST_DAY_OF_MONTH);

  const firstDayOfWeekOffset = getFirstDayOfWeekOffset(firstDayOfMonthDateTime, firstDayOfWeek) - 7;
  const gridSize = {
    columns: LENGTH_OF_WEEK,
    rows: getCalendarRows(firstDayOfMonthDateTime, firstDayOfWeekOffset) + 1,
  };
  // Pre-allocate the array, map is used instead of fill to avoid pass-by-reference errors
  const days = Array.from<CalendarMonthDay[]>({ length: gridSize.rows }).map(() => new Array(gridSize.columns) as CalendarMonthDay[]);
  let dayOffset = firstDayOfWeekOffset;
  for (let weekIndex = 0; weekIndex < gridSize.rows; weekIndex++) {
    for (let dayIndex = 0; dayIndex < gridSize.columns; dayIndex++) {
      const weekDayDateTime = firstDayOfMonthDateTime.addDays(dayOffset);
      days[weekIndex][dayIndex] = {
        date: weekDayDateTime.getDayOfMonth(),
        weekday: weekDayDateTime.getWeekday(),
        month: weekDayDateTime.getMonth(),
        year: weekDayDateTime.getFullYear(),
        display: weekDayDateTime.setLocale(locale).formatCalendarDateDisplay(),
      };
      dayOffset++;
    }
  }

  return {
    weeks: days,
    firstDayOfWeek,
  };
};

export const generateCalendarYear = ({
  dtl,
  locale,
  year,
}: GenerateCalendarYearOptions): CalendarYear => {
  if (!dtl || !locale) {
    return {
      months: [],
    };
  }

  const gridSize = {
    columns: 3,
    rows: 4,
  };
  // Pre-allocate the array, map is used instead of fill to avoid pass-by-reference errors
  const months = Array.from<CalendarYearMonth[]>({ length: gridSize.rows }).map(() => new Array(gridSize.columns) as CalendarYearMonth[]);
  const firstDayOfYearDateTime = dtl.getValueForDate(year, FIRST_MONTH_OF_YEAR, FIRST_DAY_OF_MONTH);
  for (let quarterIndex = 0; quarterIndex < gridSize.rows; quarterIndex++) {
    for (let monthIndex = 0; monthIndex < gridSize.columns; monthIndex++) {
      const weekDayDateTime = firstDayOfYearDateTime.addMonths(quarterIndex * 3 + monthIndex);
      months[quarterIndex][monthIndex] = {
        year,
        month: weekDayDateTime.getMonth(),
        display: weekDayDateTime.setLocale(locale).formatCalendarMonthDisplay(),
      };
    }
  }

  return { months };
};

export const generateCalendarDecade = ({
  dtl,
  locale,
  year,
}: GenerateCalendarDecadeOptions): CalendarDecade => {
  if (!dtl || !locale) {
    return {
      rows: [],
    };
  }

  // Pre-allocate the array, map is used instead of fill to avoid pass-by-reference errors
  const rows = Array.from<CalendarDecadeYear[]>({ length: 4 }).map(() => [] as CalendarDecadeYear[]);
  const firstYearOfDecade = year - year % 10;

  const firstYearOfDecadeDateTime = dtl.getValueForDate(firstYearOfDecade, FIRST_MONTH_OF_YEAR, FIRST_DAY_OF_MONTH);
  for (let decadeYear = 0; decadeYear < 10; decadeYear++) {
    const rowIndex = Math.floor(decadeYear / 3);
    const yearDateTime = firstYearOfDecadeDateTime.addYears(decadeYear);
    rows[rowIndex].push({
      year: yearDateTime.getFullYear(),
      display: yearDateTime.setLocale(locale).formatCalendarYearDisplay(),
    });
  }

  return { rows };
};
