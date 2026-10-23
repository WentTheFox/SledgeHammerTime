import { faChartColumn, faHammer, faPlug, faRobot, faUserGear } from '@fortawesome/free-solid-svg-icons';
import { describe, expect, it } from 'vitest';
import { PageName, pageIcons } from './pages';

describe('pageIcons', () => {
  it('has an icon for every page', () => {
    for (const page of Object.values(PageName)) {
      expect(pageIcons[page], page).toBeDefined();
    }
  });

  it('gives each page its own icon, so two pages are never mistaken for each other', () => {
    const icons = Object.values(pageIcons).map(icon => icon.iconName);

    expect(new Set(icons).size).toBe(icons.length);
  });

  it('maps the pages the way the navigation always has', () => {
    expect(pageIcons[PageName.BotInfo]).toBe(faRobot);
    expect(pageIcons[PageName.Api]).toBe(faPlug);
    expect(pageIcons[PageName.Analytics]).toBe(faChartColumn);
    expect(pageIcons[PageName.Settings]).toBe(faHammer);
    expect(pageIcons[PageName.Profile]).toBe(faUserGear);
  });

  it('names pages by their route, which is what the menu compares with the current one', () => {
    expect(Object.values(PageName)).toEqual(['botInfo', 'api', 'analytics', 'settings', 'profile.edit']);
  });
});
