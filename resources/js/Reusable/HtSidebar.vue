<script setup lang="ts">
import LanguageSelector from '@/Components/LanguageSelector.vue';
import DebugLocalSettings from '@/Components/sidebar/DebugLocalSettings.vue';
import SidebarCredits from '@/Components/sidebar/SidebarCredits.vue';
import ThemeButtonGroup from '@/Components/sidebar/ThemeButtonGroup.vue';
import UserMenu from '@/Components/UserMenu.vue';
import { layoutOptionsInject, localSettingsInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import { faAlignLeft, faAlignRight, faTimes } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const localSettingsValue = inject(localSettingsInject);
const layoutOptions = inject(layoutOptionsInject);
const isOnRight = computed(() => Boolean(localSettingsValue?.sidebarOnRight));
const isOpen = computed(() => localSettingsValue?.sidebarOpen === true);
const isClosed = computed(() => localSettingsValue?.sidebarOpen === false);

const close = () => {
  localSettingsValue?.setSidebarOpen(false);
};
</script>


<template>
  <aside :class="['sidebar', `position-${isOnRight ? 'right' : 'left'}`, { 'is-open': isOpen, 'is-closed': isClosed }]">
    <div class="sidebar-top">
      <HtButton @click="close">
        <FontAwesomeIcon :icon="faTimes" />
      </HtButton>
      <HtButton @click="localSettingsValue?.toggleSidebarOnRight()">
        <FontAwesomeIcon :icon="isOnRight ? faAlignLeft : faAlignRight" />
      </HtButton>
    </div>
    <div class="sidebar-content">
      <slot name="widgets" />
      <DebugLocalSettings />
      <SidebarCredits />
    </div>
    <div class="sidebar-bottom">
      <ul class="actions-wrapper">
        <li v-if="layoutOptions?.languageSelector">
          <LanguageSelector />
        </li>
        <li class="parallel-actions">
          <UserMenu />
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
