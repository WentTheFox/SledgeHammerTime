import type { BotInfoUsageData } from '@/injection-keys';

/**
 * Where a command run or an option use came from, in the order the graph stacks them: the bot at the bottom
 */
export const USAGE_SOURCES = ['discord-bot', 'api', 'mcp'] as const;

export const DEFAULT_USAGE_SOURCE = 'discord-bot';

export interface DailyUsage {
  total: number;
  /**
   * The values by source, only the sources that have any, in the order of {@see USAGE_SOURCES}
   */
  bySource: { source: string; value: number }[];
}

const sourceRank = (source: string): number => {
  const index = (USAGE_SOURCES as readonly string[]).indexOf(source);
  // A source this code does not know about yet goes on top, rather than being dropped
  return index === -1 ? USAGE_SOURCES.length : index;
};

/**
 * The usage of every day, split by source. The days are the ISO dates of the data, a day that is not in it has no usage.
 */
export const groupUsageByDay = (data: readonly BotInfoUsageData[]): Map<string, DailyUsage> => {
  const days = new Map<string, Map<string, number>>();
  for (const item of data) {
    const source = item.source ?? DEFAULT_USAGE_SOURCE;
    const day = days.get(item.date) ?? new Map<string, number>();
    day.set(source, (day.get(source) ?? 0) + item.value);
    days.set(item.date, day);
  }

  return new Map([...days.entries()].map(([date, bySource]) => {
    const entries = [...bySource.entries()]
      .filter(([, value]) => value > 0)
      .sort(([a], [b]) => sourceRank(a) - sourceRank(b) || a.localeCompare(b))
      .map(([source, value]) => ({ source, value }));

    return [date, { total: entries.reduce((sum, entry) => sum + entry.value, 0), bySource: entries }];
  }));
};

/**
 * The sources that have usage in the data, in the order they are stacked in
 */
export const sourcesInUse = (days: Iterable<DailyUsage>): string[] => {
  const found = new Set<string>();
  for (const day of days) {
    day.bySource.forEach(entry => found.add(entry.source));
  }

  return [...found].sort((a, b) => sourceRank(a) - sourceRank(b) || a.localeCompare(b));
};

/**
 * The same days without the sources that are switched off. The totals follow, so the graph scales to what is shown.
 */
export const withoutSources = (days: ReadonlyMap<string, DailyUsage>, hidden: ReadonlySet<string>): Map<string, DailyUsage> => {
  if (hidden.size === 0) return new Map(days);

  return new Map([...days.entries()].map(([date, day]) => {
    const bySource = day.bySource.filter(entry => !hidden.has(entry.source));

    return [date, { total: bySource.reduce((sum, entry) => sum + entry.value, 0), bySource }];
  }));
};
