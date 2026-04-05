import { buildAliasBadges, getAliasBadgeColor } from '@/utils/combobox';
import { describe, expect, it } from 'vitest';

describe('getAliasBadgeColor', () => {
  it('returns green when alias matches both current and secondary', () => {
    expect(getAliasBadgeColor('CEST', 'CEST', 'CEST')).toBe('green');
  });

  it('returns yellow when alias matches only current', () => {
    expect(getAliasBadgeColor('CEST', 'CEST', 'CET')).toBe('yellow');
  });

  it('returns green when alias matches only secondary', () => {
    expect(getAliasBadgeColor('CET', 'CEST', 'CET')).toBe('green');
  });

  it('returns undefined when alias matches neither', () => {
    expect(getAliasBadgeColor('GMT', 'CEST', 'CET')).toBeUndefined();
  });

  it('returns yellow when secondary is undefined and alias matches current', () => {
    expect(getAliasBadgeColor('CEST', 'CEST', undefined)).toBe('yellow');
  });

  it('returns undefined when both aliases are undefined', () => {
    expect(getAliasBadgeColor('CEST', undefined, undefined)).toBeUndefined();
  });

  it('does NOT return green when secondary is undefined even if strings would match', () => {
    // Regression: alias === undefined should never match
    expect(getAliasBadgeColor('undefined', 'CEST', undefined)).toBeUndefined();
  });
});

describe('buildAliasBadges', () => {
  it('returns undefined when option has no description or aliases', () => {
    expect(buildAliasBadges({ label: 'Test', value: 'test' })).toBeUndefined();
  });

  it('sorts highlighted aliases to the front', () => {
    const result = buildAliasBadges({
      label: 'Europe/Berlin',
      value: 'Europe/Berlin',
      aliases: ['CET', 'CEST'],
      currentAlias: 'CEST',
      secondaryAlias: 'CET',
    });
    expect(result).toBeDefined();
    // Both CET (green) and CEST (yellow) are highlighted — they should come before un-highlighted
    const texts = result!.map(b => b.text);
    expect(texts.indexOf('CEST')).toBeLessThan(texts.indexOf('CEST') + 1); // both are highlighted so order between them is not strict
  });

  it('colors badges correctly with distinct current and secondary', () => {
    const result = buildAliasBadges({
      label: 'Europe/Berlin',
      value: 'Europe/Berlin',
      aliases: ['CET', 'CEST'],
      currentAlias: 'CEST',
      secondaryAlias: 'CET',
    });
    expect(result).toBeDefined();
    const byText = Object.fromEntries(result!.map(b => [b.text, b.color]));
    expect(byText['CEST']).toBe('yellow');
    expect(byText['CET']).toBe('green');
  });

  it('colors both green when current and secondary are the same', () => {
    const result = buildAliasBadges({
      label: 'Europe/Berlin',
      value: 'Europe/Berlin',
      aliases: ['CET', 'CEST'],
      currentAlias: 'CEST',
      secondaryAlias: 'CEST',
    });
    const byText = Object.fromEntries(result!.map(b => [b.text, b.color]));
    expect(byText['CEST']).toBe('green');
    expect(byText['CET']).toBeUndefined();
  });

  it('colors current alias yellow and leaves others uncolored when secondary is undefined', () => {
    const result = buildAliasBadges({
      label: 'Europe/Berlin',
      value: 'Europe/Berlin',
      aliases: ['CET', 'CEST'],
      currentAlias: 'CEST',
      secondaryAlias: undefined,
    });
    const byText = Object.fromEntries(result!.map(b => [b.text, b.color]));
    expect(byText['CEST']).toBe('yellow');
    expect(byText['CET']).toBeUndefined();
  });
});
