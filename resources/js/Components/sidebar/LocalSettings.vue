<script setup lang="ts">
import { devModeInject, localSettingsInject } from '@/injection-keys';
import { faCode } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';

const settings = inject(localSettingsInject);
const devMode = inject(devModeInject);
</script>

<template>
  <section v-if="devMode">
    <header>
      <FontAwesomeIcon
        :icon="faCode"
        :fixed-width="true"
      />
      <span class="ms-1">{{ $t('global.sidebar.localSettings.title') }}</span>
    </header>

    <pre><code>{{ JSON.stringify(settings, null, 2) }}</code></pre>
  </section>
</template>

<style scoped>

</style>
