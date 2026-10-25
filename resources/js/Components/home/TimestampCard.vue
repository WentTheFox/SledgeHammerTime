<script setup lang="ts">
import TimestampTable from '@/Components/home/table/TimestampTable.vue';
import TimestampPicker from '@/Components/home/TimestampPicker.vue';
import { useLocale } from '@/composables/useLocale';
import { useUiLocale } from '@/composables/useUiLocale';
import { localSettingsInject, pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import { wTrans } from 'laravel-vue-i18n';
import { computed, inject } from 'vue';

const pageProps = inject(pagePropsInject);
const locale = useLocale(pageProps);
const uiLocale = useUiLocale(pageProps, locale);
const settings = inject(localSettingsInject);

const handleHowToClose = () => {
  settings?.setHowTo(false);
};

const syntaxColName = computed(() => {
  const originalText = wTrans('timestampPicker.table.syntaxColumn');
  // Lowercase column name in text only for this language
  if (uiLocale.value === 'pt-BR') {
    return originalText.value.toLowerCase();
  }
  return originalText.value;
});

</script>

<template>
  <HtAlert
    v-if="!settings?.hideHowTo"
    type="info"
    @close="handleHowToClose"
  >
    <template #title>
      {{ $t('global.seoDescription') }}
    </template>
    <template #text>
      {{ $t('timestampPicker.howTo', { syntaxColName }) }}
    </template>
  </HtAlert>

  <HtCard>
    <h1 class="visually-hidden">
      {{ $t('global.seoDescription') }}
    </h1>

    <TimestampPicker />

    <TimestampTable />
  </HtCard>
</template>
