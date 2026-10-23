<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject, userInfoInject, userInfoLoadingInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { MISSING_ROUTE_HREF, safeRoute } from '@/utils/safe-route';
import {
  faArrowRightFromBracket,
  faBusinessTime,
  faCaretDown,
  faCaretUp,
  faChartColumn,
  faCompass,
  faHammer,
  faPlug,
  faRobot,
  faUser,
  faUserGear,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';
import { Tippy } from 'vue-tippy';

const route = useRoute();
const userInfo = inject(userInfoInject);
const userInfoLoading = inject(userInfoLoadingInject);


const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);

const analyticsRoute = computed(() => safeRoute('analytics', route, {
  routeParams: routeParams.value,
}));
const botInfoRoute = computed(() => safeRoute('botInfo', route, {
  routeParams: routeParams.value,
}));
const loginRoute = computed(() => safeRoute('login', route, {
  routeParams: routeParams.value,
}));
</script>

<template>
  <div class="user-menu">
    <Tippy
      :interactive="true"
      trigger="click"
      :arrow="false"
    >
      <template #default="{ state, hide, show }">
        <HtButton
          :color="userInfo ? 'primary' : undefined"
          :icon-start="userInfo ? faUser : faCompass"
          :icon-end="state.isVisible ? faCaretDown : faCaretUp"
          :pressed="state.isVisible"
          @click="state.isVisible ? hide : show"
        >
          {{ userInfo ? userInfo.name : $t('global.nav.menu') }}
        </HtButton>
      </template>
      <template #content="{ hide }">
        <nav class="nav">
          <Link
            :href="botInfoRoute"
            :class="['nav-link', { current: route().current() === 'botInfo'}]"
            @click.passive="hide"
          >
            <FontAwesomeIcon
              :icon="faRobot"
              :fixed-width="true"
            />
            <span>{{ $t('botInfo.heading') }}</span>
          </Link>
          <Link
            :href="safeRoute('api', route, {routeParams})"
            :class="['nav-link', { current: route().current() === 'api'}]"
            @click.passive="hide"
          >
            <FontAwesomeIcon
              :icon="faPlug"
              :fixed-width="true"
            />
            <span>{{ $t('global.nav.api') }}</span>
          </Link>
          <Link
            v-if="analyticsRoute !== MISSING_ROUTE_HREF"
            :href="analyticsRoute"
            :class="['nav-link', { current: route().current() === 'analytics'}]"
            @click.passive="hide"
          >
            <FontAwesomeIcon
              :icon="faChartColumn"
              :fixed-width="true"
            />
            <span>{{ $t('global.nav.analytics') }}</span>
          </Link>
          <template v-if="userInfo">
            <hr class="nav-divider">
            <Link
              :href="safeRoute('settings', route, {routeParams})"
              :class="['nav-link', { current: route().current() === 'settings'}]"
              @click.passive="hide"
            >
              <FontAwesomeIcon
                :icon="faHammer"
                :fixed-width="true"
              />
              <span>{{ $t('global.nav.botSettings') }}</span>
            </Link>
            <Link
              :href="safeRoute('profile.edit', route, {routeParams})"
              :class="['nav-link', { current: route().current() === 'profile.edit'}]"
              @click.passive="hide"
            >
              <FontAwesomeIcon
                :icon="faUserGear"
                :fixed-width="true"
              />
              <span>{{ $t('global.nav.profile') }}</span>
            </Link>
            <HtExternalLink
              v-if="userInfo.horizonAccess"
              :href="safeRoute('horizon.index', route, {routeParams : { view: 'dashboard' }})"
              class="nav-link"
            >
              <FontAwesomeIcon
                :icon="faBusinessTime"
                :fixed-width="true"
              />
              <span>Horizon Dashboard</span>
            </HtExternalLink>
            <Link
              :href="safeRoute('logout', route, {routeParams})"
              method="post"
              as="button"
              class="nav-link"
              @click.passive="hide"
            >
              <FontAwesomeIcon
                :icon="faArrowRightFromBracket"
                :fixed-width="true"
              />
              <span>{{ $t('actions.log_out') }}</span>
            </Link>
          </template>
        </nav>
      </template>
    </Tippy>
    <HtLinkButton
      v-if="!userInfo && loginRoute !== MISSING_ROUTE_HREF"
      color="primary"
      :href="loginRoute"
      :external="true"
      :target-blank="false"
      :loading="userInfoLoading"
    >
      {{ $t('actions.log_in') }}
    </HtLinkButton>
  </div>
</template>
