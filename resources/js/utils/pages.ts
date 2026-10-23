import { faChartColumn, faHammer, faPlug, faRobot, faUserGear } from '@fortawesome/free-solid-svg-icons';
import type { IconDefinition } from '@fortawesome/fontawesome-svg-core';

/**
 * The pages that have an icon, by the name of their route. The icon of a page is the same in the navigation menu and in
 * the title of the page, so it is defined here and nowhere else.
 */
export enum PageName {
  BotInfo = 'botInfo',
  Api = 'api',
  Analytics = 'analytics',
  Settings = 'settings',
  Profile = 'profile.edit',
}

export const pageIcons: Record<PageName, IconDefinition> = {
  [PageName.BotInfo]: faRobot,
  [PageName.Api]: faPlug,
  [PageName.Analytics]: faChartColumn,
  [PageName.Settings]: faHammer,
  [PageName.Profile]: faUserGear,
};
