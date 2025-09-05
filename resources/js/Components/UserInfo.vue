<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { currentLanguageInject, pagePropsInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import { faCaretDown, faCaretUp, faUser } from '@fortawesome/free-solid-svg-icons';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';
import { Tippy } from 'vue-tippy';

const route = useRoute();
const page = inject(pagePropsInject);
const currentLanguage = inject(currentLanguageInject);
const userInfo = computed(() => page?.value?.auth?.user);

// noinspection JSUnusedGlobalSymbols
const routeLocale = computed(() => currentLanguage?.value.locale ?? FALLBACK_LANGUAGE);
</script>

<template>
  <div class="user-info">
    <Tippy
      v-if="userInfo"
      :interactive="true"
      trigger="click"
      :arrow="false"
    >
      <template #default="{ state, hide, show }">
        <HtButton
          color="primary"
          :icon-start="faUser"
          :icon-end="state.isVisible ? faCaretDown : faCaretUp"
          :pressed="state.isVisible"
          @click="state.isVisible ? hide : show"
        >
          {{ userInfo?.name ?? $t('global.guest') }}
        </HtButton>
      </template>
      <template #content="{ hide }">
        <ul
          v-if="userInfo"
          class="user-dropdown"
        >
          <li>
            <Link
              :href="route('settings', { locale: routeLocale })"
            >
              {{ $t('global.nav.botSettings') }}
            </Link>
          </li>
          <li>
            <Link
              :href="route('profile.edit', { locale: routeLocale })"
            >
              {{ $t('global.nav.profile') }}
            </Link>
          </li>
          <li>
            <Link
              :href="route('logout')"
              method="post"
              as="button"
              class="cursor-pointer"
              @click.passive="hide"
            >
              {{ $t('actions.log_out') }}
            </Link>
          </li>
        </ul>
      </template>
    </Tippy>
    <HtLinkButton
      v-else
      color="primary"
      :href="route('login', { locale: routeLocale })"
      :external="true"
      :target-blank="false"
    >
      {{ $t('actions.log_in') }}
    </HtLinkButton>
  </div>
</template>
