<script setup lang="ts">
import MinimalLayout from '@/Layouts/MinimalLayout.vue';
import AddAppLinks from '@/Pages/AddApp/AddAppLinks.vue';
import { getAppName } from '@/utils/app';
import { Head } from '@inertiajs/vue3';

const appName = getAppName();
</script>

<template>
  <Head :title="$t('timestampPicker.usefulLinks.bot.header')" />
  <MinimalLayout>
    <div class="page">
      <img
        src="/logos/logo.png"
        alt=""
        class="logo"
      >
      <h1 class="title">
        {{ appName }}
      </h1>
      <p class="subtitle">
        {{ $t('addApp.title') }}
      </p>
      <AddAppLinks />
    </div>
  </MinimalLayout>
</template>

<style lang="scss">
@use "../../../css/design";

.page {
  color: design.app-color('add-app-color');
  background-color: design.app-color('add-app-bg');
  padding: 1em;
  width: 100%;
  min-height: 100vh;
  display: flex;
  flex-flow: column;
  justify-content: center;
  align-items: center;
}

.logo {
  width: 80px;
  height: 80px;
  border-radius: 20px;
  background-color: #000;
  border: 1px solid design.app-color('add-app-logo-border');
}

.title {
  font-size: 1.4rem;
  margin: 0.5em 0;
}

.subtitle {
  font-size: 0.9rem;
  margin: 0 0 1em;
}

.title,
.subtitle {
  text-align: center;
}
</style>
