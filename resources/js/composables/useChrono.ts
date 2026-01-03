import { CurrentLanguageData } from '@/injection-keys';
import { Chrono, de, en,
fr,
ja,
pt,
nl,
zh,
ru,
es,
uk,
it,
sv } from 'chrono-node';
import { computed, ComputedRef, Ref } from 'vue';

export const useChrono = (currentLanguage?: Ref<CurrentLanguageData>): ComputedRef<Chrono | null> => computed(() => {
  switch (currentLanguage?.value.locale) {
    case 'en':
      return en.casual;
    case 'en-GB':
      return en.GB;
    case 'de':
      return de.casual;
    case 'fr':
      return fr.casual;
    case 'ja':
      return ja.casual;
    case 'pt':
    case 'pt-BR':
      return pt.casual;
    case 'nl':
      return nl.casual;
    case 'zh':
    case 'zh-TW':
      return zh.casual;
    case 'ru':
      return ru.casual;
    case 'es':
      return es.casual;
    case 'uk':
      return uk.casual;
    case 'it':
      return it.casual;
    case 'sv':
      return sv.casual;
    default:
      return null;
  }
});
