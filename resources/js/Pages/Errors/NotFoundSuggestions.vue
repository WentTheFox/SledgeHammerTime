<script setup lang="ts">
import UsefulLinkItem from '@/Components/home/UsefulLinkItem.vue';
import UsefulLinksCard from '@/Components/home/UsefulLinksCard.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { faDiscord } from '@fortawesome/free-brands-svg-icons';
import notFoundApp from '@img/not-found-suggestions/app.png';
import notFoundPicker from '@img/not-found-suggestions/picker.png';

defineProps<{
  discordUrl?: string;
}>();
</script>

<template>
  <UsefulLinksCard :justify-center="true">
    <template #header>
      <h2 class="lead-text mb-2">
        {{ $t('global.notFound.suggestions.heading') }}
      </h2>
      <p class="lead-text">
        {{ $t('global.notFound.suggestions.description') }}
      </p>
    </template>

    <UsefulLinkItem
      :name="$t('global.notFound.suggestions.picker')"
      :desc="$t('global.seoDescription')"
      href="home"
      :is-local="true"
      :image="notFoundPicker"
    />
    <UsefulLinkItem
      :name="$t('botInfo.heading')"
      :desc="$t('global.notFound.suggestions.botInfoDescription')"
      href="botInfo"
      :is-local="true"
      :image="notFoundApp"
    />

    <template
      v-if="discordUrl"
      #footer
    >
      <div class="mt-3 text-center">
        <p class="mb-2">
          {{ $t('global.notFound.suggestions.discordCta') }}
        </p>
        <HtLinkButton
          :href="discordUrl"
          :icon-start="faDiscord"
          :external="true"
          color="primary"
        >
          {{ $t('global.notFound.suggestions.discordButton') }}
        </HtLinkButton>
      </div>
    </template>
  </UsefulLinksCard>
</template>
