import { describe, expect, it } from 'vitest';
import { format, formatDistance, formatRelative, parse } from 'date-fns';
import { ur } from './ur';

describe('date-fns ur locale', () => {
  const date = new Date(2023, 0, 1, 15, 30, 0); // Sunday

  it('formats month and weekday names', () => {
    expect(format(date, 'EEEE d MMMM y', { locale: ur })).toBe('اتوار 1 جنوری 2023');
    expect(format(new Date(2023, 11, 25), 'MMMM', { locale: ur })).toBe('دسمبر');
  });

  it('uses the long date format', () => {
    expect(format(date, 'PPPP', { locale: ur })).toBe('اتوار، 1 جنوری 2023');
  });

  it('formats distances with the right suffix', () => {
    const base = new Date(2023, 0, 10);
    expect(formatDistance(new Date(2023, 0, 8), base, { locale: ur, addSuffix: true })).toBe('2 دن پہلے');
    expect(formatDistance(new Date(2023, 0, 12), base, { locale: ur, addSuffix: true })).toBe('2 دن میں');
  });

  it('formats relative dates', () => {
    expect(formatRelative(date, date, { locale: ur })).toContain('آج');
  });

  it('parses month names and numbers back', () => {
    const parsed = parse('15 مارچ 2023', 'd MMMM y', new Date(2000, 0, 1), { locale: ur });
    expect(parsed.getFullYear()).toBe(2023);
    expect(parsed.getMonth()).toBe(2);
    expect(parsed.getDate()).toBe(15);
  });
});
