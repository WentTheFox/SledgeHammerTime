import { describe, expect, it } from 'vitest';
import { groupUsageByDay, sourcesInUse, withoutSources } from './usage-series';

describe('groupUsageByDay', () => {
  const days = groupUsageByDay([
    { date: '2026-10-01', value: 3, source: 'mcp' },
    { date: '2026-10-01', value: 5, source: 'discord-bot' },
    { date: '2026-10-01', value: 2, source: 'api' },
    { date: '2026-10-02', value: 4 },
    { date: '2026-10-03', value: 0, source: 'api' },
  ]);

  it('adds up a day and keeps the sources apart, the bot at the bottom of the stack', () => {
    expect(days.get('2026-10-01')).toEqual({
      total: 10,
      bySource: [{ source: 'discord-bot', value: 5 }, { source: 'api', value: 2 }, { source: 'mcp', value: 3 }],
    });
  });

  it('counts what has no source as the bot, like everything recorded before there were sources', () => {
    expect(days.get('2026-10-02')).toEqual({ total: 4, bySource: [{ source: 'discord-bot', value: 4 }] });
  });

  it('leaves out a source without usage that day', () => {
    expect(days.get('2026-10-03')).toEqual({ total: 0, bySource: [] });
  });

  it('has nothing for a day that is not in the data', () => {
    expect(days.has('2026-10-04')).toBe(false);
  });

  it('does not lose a source it does not know, it goes on top', () => {
    const unknown = groupUsageByDay([{ date: 'd', value: 1, source: 'carrier-pigeon' }, { date: 'd', value: 1, source: 'api' }]);

    expect(unknown.get('d')?.bySource.map(entry => entry.source)).toEqual(['api', 'carrier-pigeon']);
  });

  it('adds up several rows of the same source and day', () => {
    expect(groupUsageByDay([{ date: 'd', value: 1, source: 'api' }, { date: 'd', value: 2, source: 'api' }]).get('d')?.total).toBe(3);
  });
});

describe('sourcesInUse', () => {
  it('lists each source that has usage once, in the stacking order', () => {
    const days = groupUsageByDay([
      { date: 'a', value: 1, source: 'mcp' },
      { date: 'b', value: 1, source: 'discord-bot' },
      { date: 'c', value: 1, source: 'mcp' },
      { date: 'c', value: 0, source: 'api' },
    ]);

    expect(sourcesInUse(days.values())).toEqual(['discord-bot', 'mcp']);
  });
});

describe('withoutSources', () => {
  const days = groupUsageByDay([
    { date: 'a', value: 5, source: 'discord-bot' },
    { date: 'a', value: 3, source: 'api' },
    { date: 'b', value: 2, source: 'api' },
  ]);

  it('leaves the sources that are switched off out of every day, and the totals follow', () => {
    const shown = withoutSources(days, new Set(['api']));

    expect(shown.get('a')).toEqual({ total: 5, bySource: [{ source: 'discord-bot', value: 5 }] });
    expect(shown.get('b')).toEqual({ total: 0, bySource: [] });
  });

  it('is the same days when nothing is switched off, and does not change the original', () => {
    expect(withoutSources(days, new Set())).toEqual(days);
    withoutSources(days, new Set(['api', 'discord-bot']));
    expect(days.get('a')?.total).toBe(8);
  });
});
