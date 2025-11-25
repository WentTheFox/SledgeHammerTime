<script setup lang="ts">
import LanguageSelector from '@/Components/LanguageSelector.vue';
import InputSettings from '@/Components/sidebar/InputSettings.vue';
import LocalSettings from '@/Components/sidebar/LocalSettings.vue';
import SidebarCredits from '@/Components/sidebar/SidebarCredits.vue';
import ThemeButtonGroup from '@/Components/sidebar/ThemeButtonGroup.vue';
import UserInfo from '@/Components/UserInfo.vue';
import { localSettingsInject, sidebarState } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import { faAlignLeft, faAlignRight, faTimes } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const state = inject(sidebarState);
const localSettingsValue = inject(localSettingsInject);
const isOnRight = computed(() => Boolean(localSettingsValue?.sidebarOnRight));
const isOpen = computed(() => Boolean(state?.isOpen));

const close = () => {
  state?.setIsOpen(false);
};
</script>


<template>
  <aside :class="['sidebar', `position-${isOnRight ? 'right' : 'left'}`, { 'is-open': isOpen }]">
    <div class="sidebar-top">
      <HtButton @click="close">
        <FontAwesomeIcon :icon="faTimes" />
      </HtButton>
      <HtButton @click="localSettingsValue?.toggleSidebarOnRight()">
        <FontAwesomeIcon :icon="isOnRight ? faAlignLeft : faAlignRight" />
      </HtButton>
    </div>
    <div class="sidebar-content">
      <InputSettings />
      <slot name="widgets" />
      <LocalSettings />
      <SidebarCredits />
    </div>
    <div class="sidebar-bottom">
      <ul class="actions-wrapper">
        <li>
          <LanguageSelector />
        </li>
        <li class="parallel-actions">
          <UserInfo />
          <ThemeButtonGroup />
        </li>
      </ul>
    </div>
  </aside>
  <div class="sidebar-spacing-wrapper">
    <slot />
  </div>
  <div
    class="sidebar-close-overlay"
    :hidden="!isOpen"
    @click="close"
  />
</template>
