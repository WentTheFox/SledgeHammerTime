<script setup lang="ts">
import TimestampTable from '@/Components/home/table/TimestampTable.vue';
import TimestampPicker from '@/Components/home/TimestampPicker.vue';
import { useLocale } from '@/composables/useLocale';
import { useUiLocale } from '@/composables/useUiLocale';
import { dateTimeLibraryInject, pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtCard from '@/Reusable/HtCard.vue';
import Cookies from 'js-cookie';
import { wTrans } from 'laravel-vue-i18n';
import { computed, inject, onMounted, ref } from 'vue';

const dtl = inject(dateTimeLibraryInject);
const pageProps = inject(pagePropsInject);
const locale = useLocale(pageProps);
const uiLocale = useUiLocale(pageProps, locale);
const showHowTo = ref(false);
const howToCookieName = 'how-to-dismiss';
const howToCookieValue = 'how-to-dismiss';

const handleHowToClose = () => {
  Cookies.set(howToCookieName, howToCookieValue, {
    expires: dtl?.value.now().addYears(2).toDate(),
  });
  showHowTo.value = false;
};

const syntaxColName = computed(() => {
  const originalText = wTrans('timestampPicker.table.syntaxColumn');
  // Lowercase column name in text only for this language
  if (uiLocale.value === 'pt-BR') {
    return originalText.value.toLowerCase();
  }
  return originalText.value;
});

onMounted(() => {
  showHowTo.value = Cookies.get(howToCookieName) !== howToCookieValue;
});
</script>

<template>
  <HtAlert
    v-if="showHowTo"
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
    <TimestampPicker />

    <TimestampTable />
  </HtCard>
</template>
