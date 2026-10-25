<script setup lang="ts">
import UsefulLinkItem from '@/Components/home/UsefulLinkItem.vue';
import UsefulLinksCard from '@/Components/home/UsefulLinksCard.vue';
import { currentLanguageInject } from '@/injection-keys';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import discordTimestampGeneratorCom from '@img/screenshots/discordtimestampgeneratorcom.png';
import discordTimestampOrg from '@img/screenshots/discordtimestamporg.png';
import discordTimestampsCom from '@img/screenshots/discordtimestampscom.png';
import usefulLinksOldsite from '@img/screenshots/oldhammertimecyou.png';
import r3vfi from '@img/screenshots/r3vfi-discord-timestamps.png';
import usefulLinksTextcolor
  from '@img/screenshots/rebane2001com-discord-colored-text-generator.png';
import seshFyi from '@img/screenshots/seshfyi-timestamp.png';
import dabric from '@img/screenshots/timestampdabricxyz.png';
import timestampTools from '@img/screenshots/timestamptools-tools-discord-timestamp.png';
import discordTimestampCom from '@img/screenshots/webarchiveorg-web-https-discordtimestamp-com.png';
import discordUtils from '@img/screenshots/wwwdiscordutilscom-timestamps.png';
import usefulLinksBot from '@img/useful-links/bot.png';
import usefulLinksServer from '@img/useful-links/server.png';
import usefulLinksSubreddit from '@img/useful-links/subreddit.png';
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
      :image="usefulLinksServer"
    />
    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.bot.header')"
      :desc="$t('timestampPicker.usefulLinks.bot.p')"
      href="botInfo"
      :is-local="true"
      :image="usefulLinksBot"
    />
    <UsefulLinkItem
      :name="$t('timestampPicker.usefulLinks.oldSite.header')"
      :desc="$t('timestampPicker.usefulLinks.oldSite.p')"
      :href="'https://old.hammertime.cyou' + (!currentLanguage || currentLanguage.locale === 'en' ? '' : '/' + currentLanguage.locale)"
      :image="usefulLinksOldsite"
    />
    <UsefulLinkItem
      :desc="$t('timestampPicker.usefulLinks.textColor.p')"
      href="https://rebane2001.com/discord-colored-text-generator/"
      :image="usefulLinksTextcolor"
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
      :image="usefulLinksSubreddit"
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
      :image="r3vfi"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://timestamp.dabric.xyz/"
      :image="dabric"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discordtimestamp.com/"
      :image="discordTimestampCom"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://sesh.fyi/timestamp/"
      :image="seshFyi"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discord-timestamps.com/"
      :image="discordTimestampsCom"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://timestamp.tools/tools/discord-timestamp"
      :image="timestampTools"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://www.discordutils.com/timestamps"
      :image="discordUtils"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discordtimestampgenerator.com/"
      :image="discordTimestampGeneratorCom"
      :allow-referrer="true"
      :small-size="true"
    />
    <UsefulLinkItem
      href="https://discord-timestamp.org/"
      :image="discordTimestampOrg"
      :allow-referrer="true"
      :small-size="true"
    />
  </UsefulLinksCard>
</template>

<style scoped>

</style>
