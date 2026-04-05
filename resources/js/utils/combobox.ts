export const suggestionItemClass = 'combobox-suggestion-item';
export const selectedClass = 'selected';
export const selectedSelector = `.${selectedClass}`;
export const highlightedClass = 'highlighted';
export const highlightedSelector = `.${highlightedClass}`;

export interface ComboboxOption {
  label: string;
  value: string;
  description?: string;
  aliases?: string[];
  currentAlias?: string;
  secondaryAlias?: string;
  searchTerms?: string[];
}

export const normalizeQueryValue = (value: string) => value.trim().toLowerCase().replace(/\s+/g, '_');

export type AliasBadgeColor = 'green' | 'yellow';

type AliasMatch = 'current' | 'secondary' | 'both';

const getAliasMatch = (
  alias: string,
  currentAlias: string | undefined,
  secondaryAlias: string | undefined,
): AliasMatch | undefined => {
  const isCurrent = alias === currentAlias;
  const isSecondary = secondaryAlias !== undefined && alias === secondaryAlias;
  if (isCurrent && isSecondary) return 'both';
  if (isSecondary) return 'secondary';
  if (isCurrent) return 'current';
  return undefined;
};

export const getAliasBadgeColor = (
  alias: string,
  currentAlias: string | undefined,
  secondaryAlias: string | undefined,
): AliasBadgeColor | undefined => {
  const match = getAliasMatch(alias, currentAlias, secondaryAlias);
  if (!match) return undefined;
  return match === 'current' ? 'yellow' : 'green';
};

const aliasMatchTooltipKey: Record<AliasMatch, string> = {
  current: 'global.timezoneBadge.currently',
  secondary: 'global.timezoneBadge.atPickedDate',
  both: 'global.timezoneBadge.currentlyAndAtPickedDate',
};

export interface AliasBadgeItem {
  text: string;
  color: AliasBadgeColor | undefined;
  tooltipKey: string | undefined;
}

export const buildAliasBadges = (option: ComboboxOption): AliasBadgeItem[] | undefined => {
  const { description, aliases, currentAlias, secondaryAlias } = option;
  if (!description && !aliases?.length) return undefined;

  const isHighlighted = (text: string) => text === currentAlias || (secondaryAlias !== undefined && text === secondaryAlias);

  const descriptionArray = description ? [description] : [];
  const items = aliases
    ? [...descriptionArray, ...aliases].sort((a, b) => Number(isHighlighted(b)) - Number(isHighlighted(a)))
    : descriptionArray;

  return items.map(text => {
    const match = getAliasMatch(text, currentAlias, secondaryAlias);
    return {
      text,
      color: match ? (match === 'current' ? 'yellow' : 'green') : undefined,
      tooltipKey: match ? aliasMatchTooltipKey[match] : undefined,
    };
  });
};

export interface ComboboxAddonComponentProps {
  option: ComboboxOption;
}

export type FormComboboxSuggestionAddonMode = 'dynamic' | 'static';
