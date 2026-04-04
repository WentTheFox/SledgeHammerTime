import { TranslationCredit } from '@/model/translation-credit';
import { TranslationCreditOverride } from '@/model/translation-credit-override';

export interface LanguageConfigV1 {
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
  momentLocale?: string;
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
  credits?: TranslationCredit[];
}

export interface LanguageConfigV2 {
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
	creditOverrides?: Record<string | number, TranslationCreditOverride | null>;
}
