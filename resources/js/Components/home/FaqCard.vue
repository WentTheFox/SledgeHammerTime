<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { safeRoute } from '@/utils/safe-route';
import { faCaretDown, faCaretRight } from '@fortawesome/free-solid-svg-icons';
import { inject, ref } from 'vue';

export interface FaqEntry {
  identifier: number;
  topic: string;
  body: string;
}

defineProps<{
  faqEntries: FaqEntry[];
}>();

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);

const openIndex = ref<number | null>(null);

const toggle = (index: number) => {
  openIndex.value = openIndex.value === index ? null : index;
};

const formatFaqIdentifier = (identifier: number) => String(identifier)
  .replace(/0*([1-9]|[1-9]\d)$/, '.$1')
  .replace(/0{2}$/, '');
</script>

<template>
  <HtCard class="faq-card">
    <template #header>
      <h2>{{ $t('timestampPicker.faq.title') }}</h2>
    </template>

    <HtAlert
      type="info"
      :closable="false"
    >
      <template #text>
        <HtTranslate i18n-key="timestampPicker.faq.description">
          <template #1="slotProps">
            <HtExternalLink :href="safeRoute('discord', route, {routeParams})">
              {{ slotProps.text }}
            </HtExternalLink>
          </template>
        </HtTranslate>
      </template>
    </HtAlert>

    <div class="faq-list mt-2">
      <div
        v-for="(entry, index) in faqEntries"
        :key="entry.identifier"
        class="faq-item"
      >
        <HtButton
          class="faq-toggle"
          :full-width="true"
          :allow-overflow="true"
          justify="start"
          :aria-expanded="openIndex === index"
          :pressed="openIndex === index"
          :icon-start="openIndex === index ? faCaretDown : faCaretRight"
          @click="toggle(index)"
        >
          {{ formatFaqIdentifier(entry.identifier) }}) {{ entry.topic }}
        </HtButton>

        <HtCollapsible
          :visible="openIndex === index"
          class="mt-0"
        >
          <div
            class="faq-body"
            v-html="entry.body"
          />
        </HtCollapsible>
      </div>
    </div>
  </HtCard>
</template>
