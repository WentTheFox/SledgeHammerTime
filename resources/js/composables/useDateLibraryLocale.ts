import { DateTimeLibrary } from '@/classes/DateTimeLibrary';
import { DateTimeLibraryLocale } from '@/classes/DateTimeLibraryLocale';
import { currentLanguageInject } from '@/injection-keys';
import { computed, ComputedRef, DeepReadonly, inject, readonly } from 'vue';

export const useDateLibraryLocale = (dtl: DeepReadonly<ComputedRef<DateTimeLibrary>> | undefined) => {
  const currentLanguage = inject(currentLanguageInject);
  const localeName = computed(() => dtl?.value.getLocaleNameFromLanguageConfig(currentLanguage?.value.locale, currentLanguage?.value.languageConfig));
  const localeRef = computed<DateTimeLibraryLocale | null>(() => dtl && localeName.value ? dtl.value.localeLoader(localeName.value) : null);

  return readonly(localeRef);
};
