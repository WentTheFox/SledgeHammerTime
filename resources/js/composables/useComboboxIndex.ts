import { ComboboxOption, normalizeQueryValue } from '@/utils/combobox';
import levenshtein from 'js-levenshtein';
import { computed, ref, Ref, watch } from 'vue';

export interface ComboboxSearchIndex {
  find: Ref<(input: string) => string[]>;
}

export const useComboboxIndex = (
  dataSource: Ref<ComboboxOption[]>,
  getKeys: (option: ComboboxOption) => string[],
): ComboboxSearchIndex => {
  const indexedData = computed<Record<string, string[]>>(() => {
    const record: Record<string, string[]> = {};
    for (const option of dataSource.value) {
      for (const key of getKeys(option)) {
        (record[key] ??= []).push(option.value);
        if (key.includes('_')) {
          const noUnderscore = key.replace(/_/g, '');
          (record[noUnderscore] ??= []).push(option.value);
        }
      }
    }
    return record;
  });

  const find = ref<(value: string) => string[]>(() => []);

  watch(indexedData, (newIndexedData) => {
    find.value = (value: string): string[] => {
      const normalizedQueryValue = normalizeQueryValue(value);
      let candidates: string[] = [];

      if (normalizedQueryValue in newIndexedData) {
        candidates = [...newIndexedData[normalizedQueryValue]];
      }

      const matchingKeys = Object.keys(newIndexedData).filter(key => key.includes(normalizedQueryValue));
      if (matchingKeys.length > 0) {
        const distanceCache: Record<string, number> = {};
        const getCachedDistance = (key: string): number => {
          if (!(key in distanceCache)) {
            distanceCache[key] = levenshtein(key, normalizedQueryValue);
          }
          return distanceCache[key];
        };
        const sortedKeys = matchingKeys.sort((a, b) => getCachedDistance(a) - getCachedDistance(b));
        candidates = Array.from(new Set([
          ...candidates,
          ...sortedKeys.flatMap(key => newIndexedData[key]),
        ]));
      }

      return candidates;
    };
  }, { immediate: true });

  return { find };
};
