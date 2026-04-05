import { ComboboxSearchIndex, useComboboxIndex } from '@/composables/useComboboxIndex';
import { ComboboxOption } from '@/utils/combobox';
import { Ref } from 'vue';

const specialCharRegex = /\/(\w+)$/;

const getTimezoneKeys = (option: ComboboxOption): string[] => {
  const lowerName = option.value.toLowerCase();
  const keys = [lowerName];
  const slashPart = lowerName.match(specialCharRegex);
  if (slashPart) keys.push(slashPart[1]);
  if (option.aliases) {
    option.aliases.forEach(alias => {
      alias.toLowerCase().split(/\s/g).forEach(part => keys.push(part));
    });
  }
  if (option.description) {
    option.description.toLowerCase().split(/\s+/).forEach(word => {
      if (word && !keys.includes(word)) keys.push(word);
    });
  }
  if (option.searchTerms) {
    option.searchTerms.forEach(word => {
      if (word && !keys.includes(word)) keys.push(word);
    });
  }
  return keys;
};

export const useTimezoneIndex = (dataSource: Ref<ComboboxOption[]>): ComboboxSearchIndex =>
  useComboboxIndex(dataSource, getTimezoneKeys);
