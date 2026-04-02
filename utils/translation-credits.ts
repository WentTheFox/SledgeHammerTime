import { config as dotenvConfig } from 'dotenv';
import { promises as fs } from 'fs';
import https from 'https';
import path from 'path';
import axios from 'axios';
import localeConfig from '../lang/config.json' with { type: 'json' };
import { IndexedReportData } from '../resources/js/utils/crowdin';
import {
  AvailableLanguage,
  LatestLanguageConfigType,
} from '../resources/js/utils/language-settings';
import {
  getTranslatorIds,
  normalizeCredit,
  NormalizedCredits,
} from '../resources/js/utils/translation';
import { migrateLanguageConfig } from './helpers/migrate-language-config';

dotenvConfig({ quiet: true });

const markerString = '### Credits';
const readmeFolder = path.join(import.meta.dirname, '..');
const readmePath = path.join(readmeFolder, 'README.md');

const mapCreditToString = (credit: NormalizedCredits) => {
  const escapedDisplayName = credit.displayName.replace(/(^_|_$|_\s)/g, '\\$1');
  return `[${escapedDisplayName}](${credit.url})`;
};

/* eslint-disable no-console */

void (async () => {
  const appUrl = process.env.APP_URL;
  if (!appUrl) {
    console.warn('Missing APP_URL, skipping translation credits generation.');
    return;
  }

  const appConsoleUserToken = process.env.APP_CONSOLE_USER_TOKEN;
  if (!appConsoleUserToken) {
    console.warn('Missing APP_CONSOLE_USER_TOKEN, skipping translation credits generation.');
    return;
  }

  const bypassCache = process.argv.includes('--force');

  const caCertPath = process.env.APP_CA_CERT_PATH;
  const httpsAgent = caCertPath
    ? new https.Agent({ ca: await fs.readFile(caCertPath) })
    : undefined;
  const apiClient = axios.create({
    baseURL: appUrl,
    headers: { Authorization: `Bearer ${appConsoleUserToken}` },
    httpsAgent,
  });

  console.info('Reading README file…');
  const readmeText = await fs.readFile(readmePath, 'utf8');

  console.info('Finding marker text…');
  const markerIndex = readmeText.indexOf(markerString);
  if (markerIndex === -1) {
    throw new Error(`Marker "${markerString}" not found in ${readmePath}`);
  }
  const readmeTextBeforeMarker = readmeText.substring(0, markerIndex);

  if (bypassCache) {
    console.info('Triggering translator import with cache bypass…');
    const importResult = await apiClient.post<{ created: number; updated: number; skipped: number }>(
      '/api/import-crowdin-translators?force=true',
    );
    console.info(`Import completed: ${importResult.data.created} created, ${importResult.data.updated} updated, ${importResult.data.skipped} skipped`);
  }

  console.info('Fetching translator data from API…');
  const translatorCreditsResponse = await apiClient.get<IndexedReportData>('/api/crowdin-translator-credits');
  const rawReportData = translatorCreditsResponse.data;

  // Remap language codes from Crowdin locale codes to app locale keys.
  // Primary mapping is derived from crowdinLocale in config (e.g. 'sv-SE' → 'sv').
  // Additional hardcoded entries cover cases not expressible via crowdinLocale.
  const crowdinLocaleToAppLocale: Record<string, string> = {
    'no': 'nb',      // Crowdin uses 'no' for Norwegian; app uses 'nb'
    'ur-PK': 'ur',   // Crowdin uses 'ur-PK' for Urdu; app uses 'ur'
  };
  for (const [locale, cfg] of Object.entries(localeConfig.languages) as [AvailableLanguage, LatestLanguageConfigType][]) {
    if (cfg.crowdinLocale) {
      crowdinLocaleToAppLocale[cfg.crowdinLocale] = locale;
    }
  }
  // Merge all Crowdin language entries into the correct app locale key.
  // Multiple Crowdin codes can map to the same app locale (e.g. 'no' and 'nb' both → 'nb'),
  // so translatorIds are deduplicated across them.
  const remappedLanguages: IndexedReportData['languages'] = {};
  for (const [langCode, langData] of Object.entries(rawReportData.languages)) {
    if (!langData) continue;
    const appLocale = crowdinLocaleToAppLocale[langCode] ?? langCode;
    const existing = remappedLanguages[appLocale];
    if (existing) {
      const merged = new Set([...existing.translatorIds, ...(langData.translatorIds ?? [])]);
      remappedLanguages[appLocale] = {
        ...existing,
        translatorIds: Array.from(merged),
        // Carry progress from langData if existing doesn't have it yet
        ...(!existing.progress && langData.progress ? { progress: langData.progress } : {}),
      };
    } else {
      remappedLanguages[appLocale] = langData;
    }
  }
  const indexedReportData: IndexedReportData = { ...rawReportData, languages: remappedLanguages };

  const assembledReportDataOutputPath = path.join(readmeFolder, 'lang', 'crowdin.json');
  console.info(`Writing assembled report data to ${assembledReportDataOutputPath}…`);
  // Normalise key ordering to match the original file format and minimise diffs:
  // users and language keys sorted numerically/alphabetically; translatorIds sorted numerically.
  const sortedUsers = Object.fromEntries(
    Object.entries(indexedReportData.users).sort(([a], [b]) => Number(a) - Number(b)),
  );
  const sortedLanguages = Object.fromEntries(
    Object.entries(indexedReportData.languages)
      .sort(([a], [b]) => a.localeCompare(b))
      .map(([locale, data]) => [
        locale,
        data
          ? { ...data, translatorIds: [...data.translatorIds].sort((a, b) => Number(a) - Number(b)) }
          : data,
      ]),
  );
  const normalisedReportData = { ...indexedReportData, users: sortedUsers, languages: sortedLanguages };
  const assembledReportDataString = JSON.stringify(normalisedReportData, null, 2);
  await fs.writeFile(assembledReportDataOutputPath, assembledReportDataString);

  const localesConfigPath = path.join(readmeFolder, 'lang', 'config.json');
  await migrateLanguageConfig(localesConfigPath);

  console.info('Generating credits text…');
  const creditsText = [markerString, ''];
  const sortedConfigs = (Object.entries(localeConfig.languages) as [AvailableLanguage, LatestLanguageConfigType][]).sort(
    ([, { name: c1Name }], [, { name: c2Name }]) => c1Name.localeCompare(c2Name),
  );
  sortedConfigs.forEach(([locale, config]) => {
    const localeReportData = indexedReportData.languages[locale];
    const languageString = `- ${config.emoji ? `${config.emoji} ` : ''}${config.name}`;
    const translatorIds = getTranslatorIds(config, localeReportData);
    if (translatorIds.length > 0) {
      const sortedCredits = translatorIds
        .map((crowdinId) => normalizeCredit(crowdinId, config.creditOverrides, indexedReportData))
        .filter((credit): credit is NormalizedCredits => credit !== null)
        .sort((cr1, cr2) => cr1.displayName.localeCompare(cr2.displayName));
      const creditCount = sortedCredits.length;
      switch (creditCount) {
        case 0:
          // No credits, omit language from README (primarily for included languages)
          break;
        case 1:
          creditsText.push(`${languageString}: ${mapCreditToString(sortedCredits[0])}`);
          break;
        default: {
          creditsText.push(languageString);

          sortedCredits.forEach((credit) => {
            creditsText.push(`  - ${mapCreditToString(credit)}`);
          });
        }
      }
    }
  });
  const finalReadme = `${readmeTextBeforeMarker + creditsText.join('\n')}\n`;

  console.info('Writing updated README file…');
  await fs.writeFile(readmePath, finalReadme, 'utf8');

  console.info('README file updated');
})();
