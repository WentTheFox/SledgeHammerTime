<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject, userInfoInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { safeRoute } from '@/utils/safe-route';
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
import { inject } from 'vue';
import { Tippy } from 'vue-tippy';

const route = useRoute();
const userInfo = inject(userInfoInject);


const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
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
            :href="safeRoute('settings', route, routeParams)"
            :class="['nav-link', { current: route().current() === 'settings'}]"
          >
            <FontAwesomeIcon
              :icon="faHammer"
              class="me-1"
            />
            {{ $t('global.nav.botSettings') }}
          </Link>
          <Link
            :href="safeRoute('profile.edit', route, routeParams)"
            :class="['nav-link', { current: route().current() === 'profile.edit'}]"
          >
            <FontAwesomeIcon
              :icon="faUserGear"
              class="me-1"
            />
            {{ $t('global.nav.profile') }}
          </Link>
          <Link
            :href="safeRoute('logout', route, routeParams)"
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
      :href="safeRoute('login', route, routeParams)"
      :external="true"
      :target-blank="false"
    >
      {{ $t('actions.log_in') }}
    </HtLinkButton>
  </div>
</template>
