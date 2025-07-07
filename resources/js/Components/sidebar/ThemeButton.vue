<script setup lang="ts">
import { themeInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import { faMoon, faPalette, faSun } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject, ref } from 'vue';
import { Tippy } from 'vue-tippy';

const theme = inject(themeInject);
const isDesktop = ref(true);
</script>

<template>
  <Tippy content-class="theme-button-tooltip">
    <HtButton
      :icon-start="theme?.isLightTheme ? faMoon : faSun"
      :icon-only="true"
      @click.passive="theme?.changeTheme(!theme?.isLightTheme)"
      @touchstart.passive="isDesktop = false"
      @touchend.passive="isDesktop = false"
      @touchmove.passive="isDesktop = false"
      @mousemove.passive="isDesktop = true"
      @contextmenu.prevent="theme?.changeTheme(null)"
    />
    <template #content>
      <FontAwesomeIcon
        :icon="faPalette"
        class="me-1"
      />
      {{ theme?.isLightTheme ? $t('global.sidebar.themeButton.dark') : $t('global.sidebar.themeButton.light') }}
      <small
        v-if="!theme?.usingSystemStyle"
        class="theme-button-tooltip-reset-hint"
      >
        {{ isDesktop ? $t('global.sidebar.themeButton.resetMouse') : $t('global.sidebar.themeButton.resetTouch') }}
      </small>
    </template>
  </Tippy>
</template>
