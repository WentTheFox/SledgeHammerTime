<script setup lang="ts">
import CustomFlag from '@/Components/CustomFlag.vue';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { currentLanguageInject, pagePropsInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import HtProgress from '@/Reusable/HtProgress.vue';
import { getTranslationCompletePercent, reportData } from '@/utils/crowdin';
import { AvailableLanguage, LANGUAGES, LatestLanguageConfigType } from '@/utils/language-settings';
import { faCaretDown, faCaretUp, faLanguage, faLifeRing } from '@fortawesome/free-solid-svg-icons';
import { router } from '@inertiajs/vue3';
import { computed, inject, onMounted, ref } from 'vue';
import { Tippy } from 'vue-tippy';
import nativeLocaleNames
  from '../../../vendor/laravel-lang/native-locale-names/data/_native.json' with { type: 'json' };

const searchParams = ref<URLSearchParams | null>(null);

const route = useRoute();
const currentLanguage = inject(currentLanguageInject);

const extendedNativeLocaleNames: Record<AvailableLanguage, string> = {
  ...nativeLocaleNames,
  'en': 'English, US',
  'en-GB': 'English, UK',
  'zh': nativeLocaleNames['zh_CN'],
  'zh-TW': nativeLocaleNames['zh_TW'],
  'pt-BR': nativeLocaleNames['pt_BR'],
  'sr': nativeLocaleNames['sr_Latn'],
};

const noTranslationsNeededLocales = new Set(['en', 'en-GB', 'hu']);

const sortedLanguages = computed(() =>
  (Object.entries(LANGUAGES) as [AvailableLanguage, LatestLanguageConfigType][])
    .filter(([key, config]) => {
      if (!currentLanguage?.value.languages) return true;
      if (config.laravelLocale) {
        return config.laravelLocale in currentLanguage.value.languages;
      }
      return key in currentLanguage.value.languages;
    })
    .sort(([a], [b]) => extendedNativeLocaleNames[a].localeCompare(extendedNativeLocaleNames[b])),
);

const displayContributionHints = computed(() =>
  Boolean(currentLanguage?.value?.locale && !noTranslationsNeededLocales.has(currentLanguage.value?.locale)),
);

const currentLanguageApprovalPercent = computed(() =>
  currentLanguage?.value.locale
    ? getTranslationCompletePercent(reportData.languages[currentLanguage.value.locale]?.progress)
    : 100,
);

const searchParamsString = computed(() => {
  return searchParams.value && searchParams.value.size > 0 ? `?${searchParams.value}` : '';
});

const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);

const parameterRequiredRegex = /Ziggy error: '([^']+)' parameter is required/i;
const getCurrentRouteFromLocale = (locale: string, additionalParameters?: Record<string, string>) => {
  const currentRouteName = route().current() ?? 'home';
  const currentRouteParams = routeParams.value;
  try {
    return route(currentRouteName, { ...currentRouteParams, ...additionalParameters, locale });
  } catch (e) {
    if (typeof e === 'object' && e !== null && 'message' in e && typeof e.message === 'string') {
      const parameterMatch = e.message.match(parameterRequiredRegex);
      if (parameterMatch) {
        return getCurrentRouteFromLocale(locale, {
          ...additionalParameters,
          [parameterMatch[1]]: '',
        });
      }
    }
  }
};

const navigateListener = () => {
  searchParams.value = new URLSearchParams(window.location.search);
};
onMounted(router.on('success', navigateListener));
</script>

<template>
  <div class="language-selector">
    <div
      v-if="currentLanguage?.languageConfig"
      class="language-info"
      :dir="currentLanguage.languageConfig.rtl ? 'rtl' : 'ltr'"
    >
      <div class="language-flag">
        <CustomFlag
          :country="currentLanguage.languageConfig.countryCode"
          :custom-flag="currentLanguage.languageConfig.customFlag"
        />
      </div>
      <div class="language-name">
        {{ extendedNativeLocaleNames[currentLanguage.locale] }}
      </div>
    </div>
    <div
      v-if="displayContributionHints && currentLanguageApprovalPercent < 100"
      class="language-progress mb-2"
    >
      <p class="mb-1">
        {{ $t('global.incompleteTranslations') }}
      </p>
      <HtProgress :progress="currentLanguageApprovalPercent" />
    </div>
    <div class="language-controls">
      <div class="change-language-button-wrap">
        <Tippy
          content-class="language-list"
          trigger="click"
          :interactive="true"
          :arrow="false"
        >
          <template #default="{ state }">
            <HtButton
              :block="true"
              class="change-language-button"
              :icon-start="faLanguage"
              :icon-end="state.isVisible ? faCaretDown : faCaretUp"
              :justify-center="true"
              :pressed="state.isVisible"
            >
              <span>{{ $t('global.changeLanguage') }}</span>
            </HtButton>
          </template>
          <template #content>
            <nav class="nav">
              <a
                v-for="[sortedLocale, config] in sortedLanguages"
                :key="sortedLocale"
                :href="getCurrentRouteFromLocale(sortedLocale)+searchParamsString"
                :class="['language-link nav-link', { disabled: !currentLanguage?.supportedLanguages?.has(sortedLocale), current: sortedLocale === currentLanguage?.locale }]"
                :dir="config.rtl ? 'rtl' : 'ltr'"
              >
                <span class="language-flag">
                  <CustomFlag
                    :country="config.countryCode"
                    :custom-flag="config.customFlag"
                  />
                </span>
                <span class="language-name">{{ extendedNativeLocaleNames[sortedLocale] }}</span>
              </a>
            </nav>
          </template>
        </Tippy>
      </div>
      <HtLinkButton
        v-if="displayContributionHints && currentLanguage?.crowdinProjectId"
        color="success"
        class="contribute-button"
        :icon-start="faLifeRing"
        :href="`https://crowdin.com/project/${currentLanguage.crowdinProjectId}/${currentLanguage?.languageConfig?.crowdinLocale || currentLanguage?.locale}`"
        :external="true"
        :target-blank="true"
      >
        <span>{{ $t('global.contributeTranslations') }}</span>
      </HtLinkButton>
    </div>
  </div>
</template>
