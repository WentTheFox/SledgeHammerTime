import { useVirtualList } from '@vueuse/core';
import type { ComboboxOption } from '@/utils/combobox';
import { computed, nextTick, ref, useTemplateRef, watch, watchEffect } from 'vue';
import type { ComputedRef, Ref } from 'vue';

export type StickyHeaderDisplayItem =
  | { type: 'header'; key: string; label: string }
  | { type: 'option'; key: string; option: ComboboxOption; index: number; displayLabel: string };

/**
 * Manages the suggestion list for the combobox: virtual scrolling, sticky group headers, and
 * all scroll-related behaviour (centering highlighted items, page up/down).
 *
 * The template ref `'sticky-overlay-el'` must exist on the overlay element in the component
 * template for the sticky header offset calculation to work.
 */
export function useComboboxSuggestionList({
  filteredOptions,
  highlightedIndex,
  showSuggestions,
  normalizedInputValue,
  stickyHeaders,
}: {
  filteredOptions: ComputedRef<ComboboxOption[]>;
  highlightedIndex: Ref<number>;
  showSuggestions: Ref<boolean>;
  normalizedInputValue: ComputedRef<string>;
  stickyHeaders: Ref<boolean>;
}) {
  // ---- Display items ----
  // Flat list with optional group-header items interleaved.
  // Headers are suppressed when the user is actively filtering (search query present).
  const displayItems = computed<StickyHeaderDisplayItem[]>(() => {
    if (!stickyHeaders.value || normalizedInputValue.value) {
      return filteredOptions.value.map((option, index) => ({
        type: 'option' as const,
        key: option.value,
        option,
        index,
        displayLabel: option.label,
      }));
    }

    const items: StickyHeaderDisplayItem[] = [];
    let lastGroup = '';
    filteredOptions.value.forEach((option, index) => {
      const slashIndex = option.label.indexOf('/');
      const groupName = slashIndex !== -1 ? option.label.substring(0, slashIndex) : '';
      if (groupName && groupName !== lastGroup) {
        items.push({ type: 'header', key: `header-${groupName}`, label: groupName });
        lastGroup = groupName;
      }
      items.push({
        type: 'option',
        key: option.value,
        option,
        index,
        displayLabel: groupName ? option.label.substring(groupName.length + 1) : option.label,
      });
    });
    return items;
  });

  // ---- Virtual scrolling ----
  // Initial heights are estimates in px; corrected once after the first render.
  const measuredOptionHeight = ref(58);
  const measuredHeaderHeight = ref(28);

  const {
    list: virtualItems,
    containerProps: vueuseContainerProps,
    wrapperProps,
  } = useVirtualList(displayItems, {
    itemHeight: (i) => {
      const item = displayItems.value[i];
      return item?.type === 'header' ? measuredHeaderHeight.value : measuredOptionHeight.value;
    },
    overscan: 5,
  });

  const containerRef = vueuseContainerProps.ref;

  // Measure actual rendered heights once and update the estimates so subsequent
  // scroll calculations are accurate.
  let heightsMeasured = false;
  watchEffect(() => {
    if (!showSuggestions.value || virtualItems.value.length === 0 || heightsMeasured) return;
    heightsMeasured = true;
    const container = containerRef.value;
    if (!container) return;
    const optionEl = container.querySelector<HTMLElement>('[data-value]');
    if (optionEl) measuredOptionHeight.value = optionEl.offsetHeight;
    const headerEl = container.querySelector<HTMLElement>('.combobox-suggestion-header:not(.combobox-suggestion-header-overlay)');
    if (headerEl) measuredHeaderHeight.value = headerEl.offsetHeight;
  }, { flush: 'post' });

  // ---- Sticky header overlay ----
  const scrollTop = ref(0);

  // Merged container props: VueUse's virtual-range updater + our scroll-position tracker.
  const containerProps = {
    ref: containerRef,
    onScroll: () => {
      vueuseContainerProps.onScroll();
      scrollTop.value = containerRef.value?.scrollTop ?? 0;
    },
  };

  // Precomputed pixel offsets for each header in the full (non-virtual) list.
  const headerPositions = computed<Map<string, number>>(() => {
    if (!stickyHeaders.value) return new Map();
    let top = 0;
    const map = new Map<string, number>();
    for (const item of displayItems.value) {
      if (item.type === 'header') map.set(item.label, top);
      top += item.type === 'header' ? measuredHeaderHeight.value : measuredOptionHeight.value;
    }
    return map;
  });

  // Find the last header whose top edge is at or above the current scroll position.
  const currentStickyHeader = computed<string | null>(() => {
    if (!stickyHeaders.value) return null;
    let result: string | null = null;
    for (const [label, top] of headerPositions.value) {
      if (top <= scrollTop.value) result = label;
      else break;
    }
    return result;
  });

  // Show the overlay only once the real header div has fully scrolled above the viewport.
  const showStickyHeaderOverlay = computed<boolean>(() => {
    if (!currentStickyHeader.value) return false;
    const headerTop = headerPositions.value.get(currentStickyHeader.value) ?? 0;
    return scrollTop.value >= headerTop + measuredHeaderHeight.value;
  });

  // Template ref matched by `ref="sticky-overlay-el"` on the overlay element.
  const overlayRef = useTemplateRef<HTMLElement>('sticky-overlay-el');

  // ---- Scroll control ----

  // Center the highlighted option in the visible area, accounting for the sticky overlay height.
  const scrollHighlightedOptionIntoView = () => {
    const highlightedOption = filteredOptions.value[highlightedIndex.value];
    if (!highlightedOption) return;
    const container = containerRef.value;
    if (!container) return;

    const displayIndex = displayItems.value.findIndex(
      item => item.type === 'option' && item.option.value === highlightedOption.value,
    );
    if (displayIndex === -1) return;

    let itemTop = 0;
    for (let i = 0; i < displayIndex; i++) {
      const item = displayItems.value[i];
      itemTop += item.type === 'header' ? measuredHeaderHeight.value : measuredOptionHeight.value;
    }

    const overlayHeight = overlayRef.value?.offsetHeight ?? 0;
    const availableHeight = container.clientHeight - overlayHeight;
    container.scrollTop = Math.max(0, itemTop - overlayHeight - availableHeight / 2 + measuredOptionHeight.value / 2);
  };

  // Scroll by half a page in the given direction and return the value of the option
  // that ends up at the leading edge of the visible area (null if none found).
  const scrollByPage = async (direction: 1 | -1): Promise<string | null> => {
    const container = containerRef.value;
    if (!container) return null;
    container.scrollTop += container.getBoundingClientRect().height / 2 * direction;
    await nextTick();
    const containerRect = container.getBoundingClientRect();
    const items = Array.from(container.querySelectorAll<HTMLElement>('[data-value]'));
    const fromEnd = direction > 0;
    for (let i = fromEnd ? items.length - 1 : 0; fromEnd ? i > -1 : i < items.length; i -= direction) {
      const { bottom, top } = items[i].getBoundingClientRect();
      if (bottom <= containerRect.bottom && top >= containerRect.top) {
        return items[i].dataset.value ?? null;
      }
    }
    return null;
  };

  // Reset scroll position when the user types so the best matches at the top are visible.
  watch(normalizedInputValue, (newValue, oldValue) => {
    if (!showSuggestions.value || !newValue || newValue === oldValue) return;
    const container = containerRef.value;
    if (container) container.scrollTop = 0;
    scrollTop.value = 0;
  });

  // When the dropdown opens, wait for Vue to mount the container and for detectSelectMode's
  // nextTick to set highlightedIndex, then scroll the selected item into view.
  watch(showSuggestions, async (visible) => {
    if (!visible) return;
    await nextTick();
    await nextTick();
    if (highlightedIndex.value !== -1) scrollHighlightedOptionIntoView();
  });

  return {
    containerRef,
    containerProps,
    wrapperProps,
    virtualItems,
    overlayRef,
    showStickyHeaderOverlay,
    currentStickyHeader,
    scrollHighlightedOptionIntoView,
    scrollByPage,
  };
}
