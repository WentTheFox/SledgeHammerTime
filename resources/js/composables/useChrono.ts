import type { Chrono } from 'chrono-node';
import { CurrentLanguageData } from '@/injection-keys';
import { computed, ComputedRef, ref, Ref, watch } from 'vue';

export const useChrono = (currentLanguage?: Ref<CurrentLanguageData>): ComputedRef<Chrono | null> => {
  if (import.meta.env.SSR) return computed(() => null);

  const chronoInstance = ref<Chrono | null>(null);

  watch(
    () => currentLanguage?.value.locale,
    async (locale) => {
      const chrono = await import('chrono-node');
      switch (locale) {
        case 'en':
          chronoInstance.value = chrono.en.casual;
          break;
        case 'en-GB':
          chronoInstance.value = chrono.en.GB;
          break;
        case 'de':
          chronoInstance.value = chrono.de.casual;
          break;
        case 'fr':
          chronoInstance.value = chrono.fr.casual;
          break;
        case 'ja':
          chronoInstance.value = chrono.ja.casual;
          break;
        case 'pt':
        case 'pt-BR':
          chronoInstance.value = chrono.pt.casual;
          break;
        case 'nl':
          chronoInstance.value = chrono.nl.casual;
          break;
        case 'zh':
        case 'zh-TW':
          chronoInstance.value = chrono.zh.casual;
          break;
        case 'ru':
          chronoInstance.value = chrono.ru.casual;
          break;
        case 'es':
          chronoInstance.value = chrono.es.casual;
          break;
        case 'uk':
          chronoInstance.value = chrono.uk.casual;
          break;
        case 'it':
          chronoInstance.value = chrono.it.casual;
          break;
        case 'sv':
          chronoInstance.value = chrono.sv.casual;
          break;
        default:
          chronoInstance.value = null;
      }
    },
    { immediate: true },
  );

  return computed(() => chronoInstance.value);
};
