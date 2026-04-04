export interface LanguageConfigV3 {
  /**
   * Language name in English
   */
  name: string;
  /**
   * Language name in the language itself
   */
  nativeName: string;
  countryCode: string;
  emoji?: string;
  customFlag?: boolean;
  rtl?: boolean;
  dateFnsLocale?: string;
  crowdinLocale?: string;
  laravelLocale?: string;
  percent?: number;
  calendarLabelFormat?: string;
  calendarYearLabelFormat?: string;
  calendarWeekdayFormat?: string;
  weekendDays?: number[];
  firstDayOfWeek?: number;
  blueDay?: number;
}
