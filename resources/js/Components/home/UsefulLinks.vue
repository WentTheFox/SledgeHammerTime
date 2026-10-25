<script setup lang="ts">
import UsefulLinkItem from '@/Components/home/UsefulLinkItem.vue';
import UsefulLinksCard from '@/Components/home/UsefulLinksCard.vue';
import { currentLanguageInject } from '@/injection-keys';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import discordTimestampGeneratorComDark from '@img/screenshots/dark/discordtimestampgeneratorcom.png';
import discordTimestampOrgDark from '@img/screenshots/dark/discordtimestamporg.png';
import discordTimestampsComDark from '@img/screenshots/dark/discordtimestampscom.png';
import usefulLinksOldsiteDark from '@img/screenshots/dark/oldhammertimecyou.png';
import r3vfiDark from '@img/screenshots/dark/r3vfi-discord-timestamps.png';
import usefulLinksTextcolorDark from '@img/screenshots/dark/rebane2001com-discord-colored-text-generator.png';
import seshFyiDark from '@img/screenshots/dark/seshfyi-timestamp.png';
import dabricDark from '@img/screenshots/dark/timestampdabricxyz.png';
import timestampToolsDark from '@img/screenshots/dark/timestamptools-tools-discord-timestamp.png';
import discordTimestampComDark from '@img/screenshots/dark/webarchiveorg-web-https-discordtimestamp-com.png';
import discordUtilsDark from '@img/screenshots/dark/wwwdiscordutilscom-timestamps.png';
import discordTimestampGeneratorComLight from '@img/screenshots/light/discordtimestampgeneratorcom.png';
import discordTimestampOrgLight from '@img/screenshots/light/discordtimestamporg.png';
import discordTimestampsComLight from '@img/screenshots/light/discordtimestampscom.png';
import usefulLinksOldsiteLight from '@img/screenshots/light/oldhammertimecyou.png';
import r3vfiLight from '@img/screenshots/light/r3vfi-discord-timestamps.png';
import usefulLinksTextcolorLight from '@img/screenshots/light/rebane2001com-discord-colored-text-generator.png';
import seshFyiLight from '@img/screenshots/light/seshfyi-timestamp.png';
import dabricLight from '@img/screenshots/light/timestampdabricxyz.png';
import timestampToolsLight from '@img/screenshots/light/timestamptools-tools-discord-timestamp.png';
import discordTimestampComLight from '@img/screenshots/light/webarchiveorg-web-https-discordtimestamp-com.png';
import discordUtilsLight from '@img/screenshots/light/wwwdiscordutilscom-timestamps.png';
import usefulLinksBotDark from '@img/useful-links/dark/bot.png';
import usefulLinksBotLight from '@img/useful-links/light/bot.png';
import usefulLinksServerDark from '@img/useful-links/dark/server.png';
import usefulLinksServerLight from '@img/useful-links/light/server.png';
import usefulLinksSubredditDark from '@img/useful-links/dark/subreddit.png';
import usefulLinksSubredditLight from '@img/useful-links/light/subreddit.png';
import { inject } from 'vue';

const currentLanguage = inject(currentLanguageInject);
</script>

<template>
  <UsefulLinksCard>
    <template #header>
      <p class="lead-text">
        {{ $t('timestampPicker.usefulLinks.lead') }}
      </p>
    </template>

    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.server.header')"
      :desc="$t('timestampPicker.usefulLinks.server.p')"
      href="/discord"
      :image="usefulLinksServerLight"
      :dark-image="usefulLinksServerDark"
    />
    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.bot.header')"
      :desc="$t('timestampPicker.usefulLinks.bot.p')"
      href="botInfo"
      :is-local="true"
      :image="usefulLinksBotLight"
      :dark-image="usefulLinksBotDark"
    />
    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.oldSite.header')"
      :desc="$t('timestampPicker.usefulLinks.oldSite.p')"
      :href="'https://old.hammertime.cyou' + (!currentLanguage || currentLanguage.locale === 'en' ? '' : '/' + currentLanguage.locale)"
      :image="usefulLinksOldsiteLight"
      :dark-image="usefulLinksOldsiteDark"
    />
    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.textColor.p')"
      href="https://rebane2001.com/discord-colored-text-generator/"
      :image="usefulLinksTextcolorLight"
      :dark-image="usefulLinksTextcolorDark"
    >
      <template #name>
        <HtTranslate i18n-key="timestampPicker.usefulLinks.textColor.header">
          <template #1="slotProps">
            <span style="color: #7781ee">{{ slotProps.text }}</span>
          </template>
        </HtTranslate>
      </template>
    </UsefulLinkItem>
    <UsefulLinkItem
      name="r/SplitSecond"
      :desc="$t('timestampPicker.usefulLinks.subreddit.p')"
      href="https://reddit.com/r/SplitSecond"
      :image="usefulLinksSubredditLight"
      :dark-image="usefulLinksSubredditDark"
    />
  </UsefulLinksCard>

  <UsefulLinksCard>
    <template #header>
      <p class="lead-text mb-2">
        {{ $t('timestampPicker.usefulLinks.competitors.lead.p1') }}
      </p>
      <p class="lead-text">
        {{ $t('timestampPicker.usefulLinks.competitors.lead.p2') }}
      </p>
    </template>

    <UsefulLinkItem
      href="https://r.3v.fi/discord-timestamps/"
      :image="r3vfiLight"
      :dark-image="r3vfiDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://timestamp.dabric.xyz/"
      :image="dabricLight"
      :dark-image="dabricDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discordtimestamp.com/"
      :image="discordTimestampComLight"
      :dark-image="discordTimestampComDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://sesh.fyi/timestamp/"
      :image="seshFyiLight"
      :dark-image="seshFyiDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discord-timestamps.com/"
      :image="discordTimestampsComLight"
      :dark-image="discordTimestampsComDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://timestamp.tools/tools/discord-timestamp"
      :image="timestampToolsLight"
      :dark-image="timestampToolsDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://www.discordutils.com/timestamps"
      :image="discordUtilsLight"
      :dark-image="discordUtilsDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discordtimestampgenerator.com/"
      :image="discordTimestampGeneratorComLight"
      :dark-image="discordTimestampGeneratorComDark"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discord-timestamp.org/"
      :image="discordTimestampOrgLight"
      :dark-image="discordTimestampOrgDark"
      :allow-referrer="true"
      :small-size="true"
    />
  </UsefulLinksCard>
</template>

<style scoped>

</style>
