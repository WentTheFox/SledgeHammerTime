<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import Layout from '@/Layouts/DefaultLayout.vue';
import { UserSettings } from '@/model/user-settings';
import AppSettingsCard from '@/Pages/Settings/AppSettingsCard.vue';
import UserSettingsForm, {
  UserSettingsFormBotTranslations,
} from '@/Pages/Settings/UserSettingsForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
  userSettings: Array<{
    user: DiscordUserInfoProps,
    settings: Partial<UserSettings>
  }>;
  defaultSettings: UserSettings;
  formatOptions?: string[];
  columnsOptions?: string[];
  botTranslations: UserSettingsFormBotTranslations;
}>();
</script>

<template>
  <Head :title="$t('botSettings.title')" />

  <Layout>
    <AppSettingsCard />

    <UserSettingsForm
      v-for="entry in userSettings"
      :key="entry.user.id"
      :entry="entry"
      :default-settings="defaultSettings"
      :format-options="formatOptions"
      :columns-options="columnsOptions"
      :bot-translations="botTranslations"
    />
  </Layout>
</template>
