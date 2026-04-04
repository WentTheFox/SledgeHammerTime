import { ComboboxOption, normalizeQueryValue } from '@/utils/combobox';
import levenshtein from 'js-levenshtein';
import { computed, ref, Ref, watch } from 'vue';

export interface DynamicIndexApi {
  find: Ref<(input: string) => string[]>;
}

const specialCharRegex = /\/(\w+)$/;
export const useTimezoneIndex = (dataSource: Ref<ComboboxOption[]>): DynamicIndexApi => {
  const indexedData = computed<Record<string, string[]>>(() => dataSource.value.reduce((record, data) => {
    const lowerName = data.value.toLowerCase();
    const lowerKeys = [lowerName];
    const slashPart = lowerName.match(specialCharRegex);
    if (slashPart) {
      lowerKeys.push(slashPart[1]);
    }
    if (data.aliases) {
      data.aliases.forEach(alias => {
        const aliasParts = alias.toLowerCase().split(/\s/g);
        aliasParts.forEach(aliasPart => {
          lowerKeys.push(aliasPart);
        });
      });
    }
    // Index description words so the Intl-generated display name is also searchable
    if (data.description) {
      data.description.toLowerCase().split(/\s+/).forEach(word => {
        if (word && !lowerKeys.includes(word)) {
          lowerKeys.push(word);
        }
      });
    }
    // Index English search terms when a localized description is shown
    if (data.searchTerms) {
      data.searchTerms.forEach(word => {
        if (word && !lowerKeys.includes(word)) {
          lowerKeys.push(word);
        }
      });
    }
    return lowerKeys.reduce((part, lowerKey) => {
      const newAdditions = { [lowerKey]: [...(part[lowerKey] ?? []), data.value] };
      if (lowerKey.includes('_')) {
        const lowerKeyNoUnderscore = lowerKey.replace(/_/g, '');
        newAdditions[lowerKeyNoUnderscore] = [...(part[lowerKeyNoUnderscore] ?? []), data.value];
      }
      return ({
        ...part,
        ...newAdditions,
      });
    }, record);
  }, {} as Record<string, string[]>));

  const find = ref<(value: string) => string[]>(() => []);

  watch(indexedData, (newIndexedData) => {
    find.value = (value: string): string[] => {
      const normalizedQueryValue = normalizeQueryValue(value);
      let candidates: string[] = [];
      if (!newIndexedData) {
        return candidates;
      }

      if (normalizedQueryValue in newIndexedData) {
        candidates = [...candidates, ...newIndexedData[normalizedQueryValue]];
      }

      const matchingKeys = Object.keys(newIndexedData).filter((key) => key.includes(normalizedQueryValue));
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
          ...sortedKeys.reduce((acc, key) => [...acc, ...newIndexedData[key]], [] as string[]),
        ]));
      }

      return candidates;
    };
  }, { immediate: true });

  return { find };
};
