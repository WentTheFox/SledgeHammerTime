<script setup lang="ts">
import { devModeInject } from '@/injection-keys';
import DesignEditor from '@/Pages/Design/DesignEditor.vue';
import HtSidebar from '@/Reusable/HtSidebar.vue';
import { inject, useSlots } from 'vue';

const devMode = inject(devModeInject);
const slots = useSlots();
</script>

<template>
  <HtSidebar>
    <template
      v-if="slots.sidebarWidgets"
      #widgets
    >
      <slot name="sidebarWidgets" />
    </template>
    <div class="content-container">
      <main class="content">
        <slot />

        <DesignEditor v-if="devMode" />
      </main>
    </div>
  </HtSidebar>
</template>
