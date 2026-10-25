// Visits every URL from a JSON file ({ "<key>": ["https://..."] }) and saves a screenshot per page.
// Configured through environment variables, see .github/workflows/screenshots.yml
const { chromium } = require('playwright');
const fs = require('node:fs');
const path = require('node:path');

const toFileName = (url) => {
  const { hostname, pathname } = new URL(url);
  // Keep multiple pages of the same domain apart by appending the path
  const simplifiedHostname = hostname.replace(/[^a-z0-9]+/gi, '');
  const simplifiedPath = pathname.replace(/^\/+|\/+$/g, '').replace(/[^a-z0-9]+/gi, '-').replace(/-+$/, '');
  return `${simplifiedHostname}${simplifiedPath ? `-${simplifiedPath}` : ''}.png`;
};

(async () => {
  const outputDir = process.env.OUTPUT_DIR;
  const urls = [
    'https://old.hammertime.cyou/',
    'https://rebane2001.com/discord-colored-text-generator/',
    'https://sesh.fyi/timestamp/',
    'https://discord-timestamps.com/',
    'https://r.3v.fi/discord-timestamps/',
    'https://web.archive.org/web/https://discordtimestamp.com/',
    'https://timestamp.tools/tools/discord-timestamp',
    'https://www.discordutils.com/timestamps',
    'https://discordtimestampgenerator.com/',
    'https://discord-timestamp.org/',
    'https://timestamp.dabric.xyz/',
  ];
  const viewport = { width: 1920, height: 1080 };

  const browser = await chromium.launch();
  let failures = 0;

  // One subfolder per color scheme, sites that support prefers-color-scheme render differently in each
  for (const colorScheme of ['light', 'dark']) {
    const schemeDir = path.join(outputDir, colorScheme);
    fs.mkdirSync(schemeDir, { recursive: true });
    const context = await browser.newContext({ viewport, colorScheme, userAgent: process.env.USER_AGENT });

    for (const url of urls) {
      const page = await context.newPage();
      try {
        await page.goto(url, { waitUntil: 'networkidle', timeout: 30_000 });
        const file = path.join(schemeDir, toFileName(url));
        await page.screenshot({
          path: file,
          fullPage: false,
          style:
            // Hide Web Archive header
            '#wm-ipp-base{display:none!important}'
        });
        console.log(`✔ [${colorScheme}] ${url} -> ${file}`);
      } catch (e) {
        failures++;
        console.error(`✘ [${colorScheme}] ${url}: ${e.message}`);
      } finally {
        await page.close();
      }
    }

    await context.close();
  }

  await browser.close();
  if (failures) process.exit(1);
})();
