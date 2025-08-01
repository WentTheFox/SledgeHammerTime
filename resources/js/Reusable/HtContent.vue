<script setup lang="ts">
import TimeSync from '@/Components/TimeSync.vue';
import { devModeInject } from '@/injection-keys';
import DesignEditor from '@/Pages/Design/DesignEditor.vue';
import HtSidebar from '@/Reusable/HtSidebar.vue';
import { inject } from 'vue';

const devMode = inject(devModeInject);
</script>

<template>
  <HtSidebar>
    <div class="content-container">
      <main class="content">
        <slot />

        <TimeSync v-if="devMode" />

        <DesignEditor v-if="devMode" />
      </main>
    </div>
  </HtSidebar>
</template>
