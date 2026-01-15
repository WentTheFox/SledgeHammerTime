import { DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';
import { WeekdayItem } from '@/utils/calendar';

interface WithFallbackIndicator {
  fallback?: true;
}

export interface WeekInfo extends WithFallbackIndicator {
  firstDay: DateTimeLibraryWeekday;
}

export enum HourCycle {
  H12 = 'h12',
  H24 = 'h24',
}

export const isValidHourCycle = (value: unknown): value is HourCycle => typeof value === 'string' && Object.values(HourCycle).includes(value as HourCycle);

/**
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/Locale/hourCycle
 */
export interface HourCycleInfo extends WithFallbackIndicator {
  hourCycle: HourCycle;
}

// eslint-disable-next-line @typescript-eslint/no-explicit-any -- Required for type compatibility
export interface DateTimeLibraryLocale<L = any> {
  readonly name: string;
  readonly lowLevelValue: L | undefined;

  getWeekInfo(): WeekInfo;

  getHourCycleInfo(): HourCycleInfo;

  getWeekdays(short?: boolean): WeekdayItem[];
}
