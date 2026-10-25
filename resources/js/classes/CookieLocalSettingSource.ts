import { LocalSettingSource } from '@/model/local-setting-source';
import { PageProps } from '@/types';
import axios from 'axios';
import { Ref } from 'vue';

export class CookieLocalSettingSource implements LocalSettingSource {
  protected settingsCookie: Record<string, string | null> | null = null;
  protected stagedSettings: Record<string, string | null> = {};
  protected writeTimer: ReturnType<typeof setTimeout> | null = null;
  protected writeThrottleMs = 200;

  constructor(protected pagePropsRef: Ref<PageProps>, protected fallbackSource: LocalSettingSource) {
  }

  getItem(key: string): string | null {
    const settings = this.readSettings();
    const settingValue = settings[key];
    if (typeof settingValue === 'string') {
      return settingValue;
    }

    const fallbackValue = this.fallbackSource.getItem(key);
    if (fallbackValue !== null) {
      this.setItem(key, fallbackValue);
    }

    return fallbackValue;
  }

  setItem(key: string, value: string): void {
    void this.writeSetting(key, value);
    try {
      this.fallbackSource.setItem(key, value);
    } catch (e) {
      console.warn(`Could not set key ${key} on fallback source to ${value}`, e);
    }
  }

  removeItem(key: string): void {
    void this.writeSetting(key, null);
    try {
      this.fallbackSource.removeItem(key);
    } catch (e) {
      console.warn(`Could not remove key ${key} from fallback source`, e);
    }
  }

  private readSettings(): Record<string, string | null> {
    const cookie = this.pagePropsRef.value.app?.settingsCookie;

    if (this.settingsCookie !== null) {
      return this.settingsCookie;
    }

    if (typeof cookie === 'string') {
      try {
        const parsedCookie = JSON.parse(cookie);
        this.settingsCookie = parsedCookie;
        return parsedCookie;
      } catch (e) {
        console.error('Failed to parse settings cookie', e);
      }
    } else {
      console.info('Settings cookie not found');
    }

    return {};
  }

  private async writeSetting(key: string, value: string | null): Promise<void> {
    this.stagedSettings[key] = value;
    if (this.writeTimer) return;
    this.writeTimer = setTimeout(() => {
      this.writeTimer = null;
      void this.writeSettings();
    }, this.writeThrottleMs);
  }

  private async writeSettings(): Promise<void> {
    const stagedSettingsCopy = this.stagedSettings;
    if (Object.keys(stagedSettingsCopy).length === 0) {
      console.info('Settings write skipped, no keys staged');
      return;
    }
    this.stagedSettings = {};
    const sentSettingsSet = Object.keys(stagedSettingsCopy).filter(k => stagedSettingsCopy[k] !== null);
    const request = axios.post<Record<string, string | null>>('/frontend/local-settings', stagedSettingsCopy, {
      responseType: 'json',
    });
    const receivedSettings = (await request).data;
    this.settingsCookie = receivedSettings;
    const receivedSettingsSet = new Set(Object.keys(receivedSettings).filter(k => stagedSettingsCopy[k] !== null));
    const keysMissingFromReceivedSettings = sentSettingsSet.filter(k => !receivedSettingsSet.has(k));
    if (keysMissingFromReceivedSettings.length > 0) {
      console.warn('The following settings are missing from the server response: ', keysMissingFromReceivedSettings);
    }
  }
}
