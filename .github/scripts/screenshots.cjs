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
    'https://sesh.fyi/timestamp/',
    'https://discord-timestamps.com/',
    'https://r.3v.fi/discord-timestamps/',
    'https://web.archive.org/web/https://discordtimestamp.com/',
    'https://timestamp.tools/tools/discord-timestamp',
    'https://www.discordutils.com/timestamps',
    'https://discordtimestampgenerator.com/',
    'https://discord-timestamp.org/',
  ];
  const viewport = { width: 1920, height: 1080 };

  fs.mkdirSync(outputDir, { recursive: true });
  const browser = await chromium.launch();
  const context = await browser.newContext({ viewport });
  let failures = 0;

  for (const url of urls) {
    const page = await context.newPage();
    try {
      await page.goto(url, { waitUntil: 'networkidle', timeout: 30_000 });
      const file = path.join(outputDir, toFileName(url));
      await page.screenshot({
        path: file,
        fullPage: false,
        // Hide Web Archive header
        style: '#wm-ipp-base{display:none!important}'
      });
      console.log(`✔ ${url} -> ${file}`);
    } catch (e) {
      failures++;
      console.error(`✘ ${url}: ${e.message}`);
    } finally {
      await page.close();
    }
  }

  await browser.close();
  if (failures) process.exit(1);
})();
