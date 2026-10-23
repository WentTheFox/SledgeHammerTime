<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import ApiKeys, { ApiKeyInfo } from '@/Pages/Api/Partials/ApiKeys.vue';
import ApiKeysLogin from '@/Pages/Api/Partials/ApiKeysLogin.vue';
import ApiOverview from '@/Pages/Api/Partials/ApiOverview.vue';
import ApiUsage from '@/Pages/Api/Partials/ApiUsage.vue';
import McpSetup from '@/Pages/Api/Partials/McpSetup.vue';
import ApiReference from '@/Pages/Api/Reference/ApiReference.vue';
import { OpenApiDocument } from '@/utils/openapi';
import { Head } from '@inertiajs/vue3';

defineProps<{
  apiUrl: string;
  openApi: OpenApiDocument | null;
  authenticated: boolean;
  apiKeys: ApiKeyInfo[];
  apiKeyScopes: string[];
  maxApiKeys: number;
  discordUsers: DiscordUserInfoProps[];
}>();
</script>

<template>
  <Head :title="$t('api.title')" />

  <Layout>
    <ApiOverview />

    <ApiKeys
      v-if="authenticated"
      :api-keys="apiKeys"
      :scopes="apiKeyScopes"
      :max-keys="maxApiKeys"
      :discord-users="discordUsers"
    />
    <ApiKeysLogin v-else />

    <ApiUsage :api-url="apiUrl" />

    <ApiReference
      :spec="openApi"
      :api-url="apiUrl"
    />

    <McpSetup :api-url="apiUrl" />
  </Layout>
</template>
