import { DateTimeLibraryWeekday } from '@/classes/DateTimeLibraryValue';

interface WithFallbackIndicator {
  fallback?: true;
}

export interface WeekInfo extends WithFallbackIndicator {
  firstDay: DateTimeLibraryWeekday;
  weekend: DateTimeLibraryWeekday[];
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
export abstract class DateTimeLibraryLocale<L = any> {
  abstract readonly name: string;
  abstract readonly lowLevelValue: L | undefined;

  abstract getWeekInfo(): WeekInfo;

  abstract getHourCycleInfo(): HourCycleInfo;

  abstract getShortWeekdays(): string[];
}
