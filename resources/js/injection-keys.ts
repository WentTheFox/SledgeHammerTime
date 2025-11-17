import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { TimezoneSelection } from '@/model/timezone-selection';
import { PageProps } from '@/types';
import { AvailableLanguage, LatestLanguageConfigType } from '@/utils/language-settings';
import { ComputedRef, DeepReadonly, InjectionKey, Ref } from 'vue';

export const timestampInject = Symbol('timestamp') as InjectionKey<{
  currentTimestamp: ComputedRef<DateTimeLibraryValue | null>,
  isLocked: ComputedRef<boolean>,
  lockedTimestampUrl: ComputedRef<string>,
  unlockedTimestampUrl: ComputedRef<string>,
  currentDate: Readonly<Ref<string>>,
  currentTime: Readonly<Ref<string>>,
  currentTimezone: Ref<TimezoneSelection>,
  changeDateString: (value: string) => void,
  changeTimeString: (value: string) => void,
  changeDateTimeString: (value: string) => void,
  changeTimezone: (value: TimezoneSelection) => void,
  setCurrentTime: () => void,
  lock: () => void,
  unlock: () => void,
}>;

export const themeInject = Symbol('theme') as InjectionKey<{
  readonly isLightTheme: boolean;
  readonly usingSystemStyle: boolean;
  readonly changeTheme: (isLight: boolean | null) => void;
}>;

export const sidebarState = Symbol('sidebarState') as InjectionKey<{
  readonly isOpen: boolean | null,
  readonly setIsOpen: (value: boolean) => void;
}>;

export interface LocalSettingsValue {
  readonly customDateInputEnabled: boolean | null;
  readonly customTimeInputEnabled: boolean | null;
  readonly combinedInputsEnabled: boolean | null;
  readonly flatUiEnabled: boolean | null;
  /**
   * This value will not be flipped on RTL layouts
   */
  readonly rawSidebarOnRight: boolean | null;
  readonly sidebarOnRight: boolean | null;
  readonly sidebarOffDesktop: boolean | null;
  readonly isLightTheme: boolean | null;
  readonly autoTimeSync: boolean | null;
  readonly toggleCustomDateInput: (e: Event) => void;
  readonly toggleCustomTimeInput: (e: Event) => void;
  readonly toggleSeparateInputs: (e: Event) => void;
  readonly toggleFlatUi: (e: Event) => void;
  readonly toggleSidebarOnRight: VoidFunction;
  readonly setSidebarOffDesktop: (value: boolean) => void;
  readonly setLightTheme: (isLight: boolean | null) => void;
  readonly toggleAutoTimeSync: (e: Event) => void;
}

export const localSettingsInject = Symbol('localSettings') as InjectionKey<LocalSettingsValue>;

export const formControlId = Symbol('formControlId') as InjectionKey<string>;

export const positionAnchor = Symbol('positionAnchor') as InjectionKey<`--${string}`>;

export const pagePropsInject = Symbol('pagePropsInject') as InjectionKey<Ref<PageProps>>;

export interface CurrentLanguageData {
  locale: AvailableLanguage;
  languages: Record<string, AvailableLanguage>;
  languageConfig: LatestLanguageConfigType | undefined;
  supportedLanguages: Set<string>;
  crowdinProjectId: string;
}

export const currentLanguageInject = Symbol('currentLanguageInject') as InjectionKey<Ref<CurrentLanguageData>>;

export const devModeInject = Symbol('devModeInject') as InjectionKey<Ref<boolean>>;

export type ScrollToSectionFunction = (id: string | undefined) => void;

export const scrollToAnchorInject = Symbol('scrollToSectionInject') as InjectionKey<ScrollToSectionFunction>;

export const dateTimeLibraryInject = Symbol('dateTimeLibraryInject') as InjectionKey<DeepReadonly<ComputedRef<DateTimeLibrary>>>;

export const timeSyncInject = Symbol('timeSyncInject') as InjectionKey<DeepReadonly<{
  t0: DateTimeLibraryValue | null;
  t1: DateTimeLibraryValue | null;
  t2: DateTimeLibraryValue | null;
  t3: DateTimeLibraryValue | null;
  ntpOffsetMs: number;
  syncing: boolean;
  syncTime(apply: boolean): Promise<void>;
}>>;

export interface BotInfoUsageFetchOptions {
  id: string;
  type: 'command' | 'option';
}

export interface BotInfoUsageData {
  date: string;
  value: number;
}

export type UsageDataFetchFunction = (options: BotInfoUsageFetchOptions) => Promise<BotInfoUsageData[]>;

export const usageDataFetcherInject = Symbol('usageDataFetcherInject') as InjectionKey<UsageDataFetchFunction>;
