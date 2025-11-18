<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { currentLanguageInject, userInfoInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { FALLBACK_LANGUAGE } from '@/utils/language-settings';
import {
  faArrowRightFromBracket,
  faCaretDown,
  faCaretUp,
  faHammer,
  faUser,
  faUserGear,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';
import { Tippy } from 'vue-tippy';

const route = useRoute();
const userInfo = inject(userInfoInject);
const currentLanguage = inject(currentLanguageInject);

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
          {{ userInfo.name }}
        </HtButton>
      </template>
      <template #content="{ hide }">
        <nav
          v-if="userInfo"
          class="nav"
        >
          <Link
            :href="route('settings', { locale: routeLocale })"
            :class="['nav-link', { current: route().current() === 'settings'}]"
          >
            <FontAwesomeIcon
              :icon="faHammer"
              class="me-1"
            />
            {{ $t('global.nav.botSettings') }}
          </Link>
          <Link
            :href="route('profile.edit', { locale: routeLocale })"
            :class="['nav-link', { current: route().current() === 'profile.edit'}]"
          >
            <FontAwesomeIcon
              :icon="faUserGear"
              class="me-1"
            />
            {{ $t('global.nav.profile') }}
          </Link>
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="nav-link"
            @click.passive="hide"
          >
            <FontAwesomeIcon
              :icon="faArrowRightFromBracket"
              class="me-1"
            />
            {{ $t('actions.log_out') }}
          </Link>
        </nav>
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
