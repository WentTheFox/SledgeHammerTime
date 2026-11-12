<script setup lang="ts">
import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { useLocale } from '@/composables/useLocale';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { useUiLocale } from '@/composables/useUiLocale';
import { pagePropsInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import LegalHeading from '@/Pages/Legal/LegalHeading.vue';
import PerformanceOptOutForm from '@/Pages/Legal/PerformanceOptOutForm.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { DEVELOPER_NAME } from '@/utils/app';
import { getGdprArticle6Url, LegalSectionIds } from '@/utils/legal';
import { safeRoute } from '@/utils/safe-route';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

defineProps<{
  lastUpdated: DateTimeLibraryValue | undefined;
}>();

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
const developerUrl = computed(() => pageProps?.value.developerUrl ?? '');
const locale = useLocale(pageProps);
const uiLocale = useUiLocale(pageProps, locale);
const gdprArticle6Url = computed(() => getGdprArticle6Url(uiLocale.value));
</script>

<template>
  <HtCard class="legal-card">
    <template #header>
      <LegalHeading
        :id="LegalSectionIds.PRIVACY_POLICY"
        :level="2"
      >
        {{ $t('legal.privacy.heading') }}
      </LegalHeading>
      <p v-if="lastUpdated">
        <HtTranslate i18n-key="legal.lastUpdated">
          <template #1>
            <TimestampPreview
              :ts="lastUpdated"
              :format="MessageTimestampFormat.LONG_DATE"
            />
          </template>
        </HtTranslate>
      </p>
    </template>

    <section class="legal-section">
      <p>
        <HtTranslate i18n-key="legal.privacy.operator">
          <template #0>
            <HtExternalLink :href="developerUrl">
              {{ DEVELOPER_NAME }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.notAffiliated">
          <template #1>
            <HtExternalLink href="https://discord.com/company">
              <sup>[*]</sup>
            </HtExternalLink>
          </template>
          <template #3>
            <HtExternalLink href="https://en.wikipedia.org/wiki/U_Can%27t_Touch_This">
              <sup>[**]</sup>
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.INFO_COLLECTION"
        :level="3"
      >
        {{ $t('legal.privacy.infoCollection.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.infoCollection.pii') }}
      </p>
      <p>
        {{ $t('legal.privacy.infoCollection.auth') }}
      </p>
      <p>
        {{ $t('legal.privacy.infoCollection.removal') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.LOG_DATA"
        :level="3"
      >
        {{ $t('legal.privacy.logData.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.logData.browserInfo') }}
      </p>
      <p>
        {{ $t('legal.privacy.logData.thirdParty') }}
      </p>
      <p>
        {{ $t('legal.privacy.logData.debugging') }}
      </p>
      <p>
        {{ $t('legal.privacy.logData.noPii') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.PERFORMANCE_MONITORING"
        :level="3"
      >
        {{ $t('legal.privacy.performance.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.performance.intro') }}
      </p>
      <p>
        {{ $t('legal.privacy.performance.serverTraces') }}
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.performance.legalBasis">
          <template #1="slotProps">
            <HtExternalLink :href="gdprArticle6Url">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
      <p>
        {{ $t('legal.privacy.performance.reporting') }}
      </p>
      <p>
        {{ $t('legal.privacy.performance.retention') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.OPT_OUT"
        :level="3"
      >
        {{ $t('legal.privacy.optOut.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.optOut.intro') }}
      </p>
      <PerformanceOptOutForm />
      <p>
        {{ $t('legal.privacy.optOut.cookie') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.TELEMETRY_STATISTICS"
        :level="3"
      >
        {{ $t('legal.privacy.telemetry.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.telemetry.statsCollection') }}
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.telemetry.telemetryOptOut">
          <template #1>
            <Link :href="safeRoute('settings', route, {routeParams})">
              {{ $t('global.nav.botSettings') }}
            </Link>
          </template>
        </HtTranslate>
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.COOKIES"
        :level="3"
      >
        {{ $t('legal.privacy.cookies.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.cookies.intro') }}
      </p>
      <p>
        {{ $t('legal.privacy.cookies.disable') }}
      </p>
      <p>
        {{ $t('legal.privacy.cookies.session') }}
      </p>
      <p>
        {{ $t('legal.privacy.cookies.optOut') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.YOUR_RIGHTS"
        :level="3"
      >
        {{ $t('legal.privacy.rights.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.rights.intro') }}
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.rights.complaint">
          <template #1="slotProps">
            <HtExternalLink href="https://www.edpb.europa.eu/about-edpb/about-edpb/members_en">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.RIGHT_TO_OBJECT"
        :level="3"
      >
        {{ $t('legal.privacy.objection.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.objection.text') }}
      </p>
    </section>

    <section class="legal-section">
      <LegalHeading
        :id="LegalSectionIds.SECURITY"
        :level="3"
      >
        {{ $t('legal.privacy.security.heading') }}
      </LegalHeading>
      <p>
        {{ $t('legal.privacy.security.noGuarantee') }}
      </p>
      <p>
        <HtTranslate i18n-key="legal.privacy.security.httpsCloudFlare">
          <template #1="slotProps">
            <HtExternalLink href="https://www.cloudflare.com/security-policy/">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </p>
      <p>
        {{ $t('legal.privacy.security.breachNotify') }}
      </p>
    </section>
  </HtCard>
</template>
