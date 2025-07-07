<script setup lang="ts">
import { themeInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import { faArrowRotateBack, faMoon, faPalette, faSun } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';
import { Tippy } from 'vue-tippy';

const theme = inject(themeInject);
</script>

<template>
  <HtButtonGroup>
    <Tippy content-class="theme-button-tooltip">
      <HtButton
        :color="theme?.isLightTheme ? 'dark' : 'light'"
        :icon-start="theme?.isLightTheme ? faMoon : faSun"
        :icon-only="true"
        @click.passive="theme?.changeTheme(!theme?.isLightTheme)"
      />
      <template #content>
        <FontAwesomeIcon
          :icon="faPalette"
          class="me-1"
        />
        {{ theme?.isLightTheme ? $t('global.sidebar.themeButton.dark') : $t('global.sidebar.themeButton.light') }}
      </template>
    </Tippy>
    <Tippy>
      <HtButton
        :icon-start="faArrowRotateBack"
        :icon-only="true"
        :pressed="theme?.usingSystemStyle"
        :disabled="theme?.usingSystemStyle"
        @click.passive="theme?.changeTheme(null)"
      />
      <template #content>
        {{ $t('global.sidebar.themeButton.system') }}
      </template>
    </Tippy>
  </HtButtonGroup>
</template>
