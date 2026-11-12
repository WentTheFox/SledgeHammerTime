<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { dateTimeLibraryInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtButton from '@/Reusable/HtButton.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { getTraceOptOutExpiry, isTraceOptedOut, setTraceOptOut } from '@/utils/trace-opt-out';
import { computed, inject, onMounted, ref } from 'vue';

// The cookie is only known in the browser: nothing is shown for SSR, and everything is read once mounted
const mounted = ref(false);
/** What is stored on this device right now, as opposed to the checkbox, which may not be saved yet */
const currentlyOptedOut = ref(false);
const optedOut = ref(false);
const justSaved = ref(false);
const dtl = inject(dateTimeLibraryInject);
/** The expiry the browser reports for the cookie, which can be sooner than what was asked for */
const cookieExpiresAt = ref<number | null>(null);
const cookieExpiry = computed(() => cookieExpiresAt.value === null ? undefined : dtl?.value.fromTimestampMsUtc(cookieExpiresAt.value));

const readCookieExpiry = async () => {
  cookieExpiresAt.value = currentlyOptedOut.value ? await getTraceOptOutExpiry() : null;
};

onMounted(async () => {
  currentlyOptedOut.value = isTraceOptedOut();
  optedOut.value = currentlyOptedOut.value;
  mounted.value = true;
  await readCookieExpiry();
});

const save = async () => {
  setTraceOptOut(optedOut.value);
  currentlyOptedOut.value = isTraceOptedOut();
  justSaved.value = true;
  await readCookieExpiry();
};
</script>

<template>
  <form
    class="performance-opt-out-form"
    @submit.prevent="save"
  >
    <p
      v-if="mounted"
      role="status"
    >
      <strong>
        {{ currentlyOptedOut ? $t('legal.privacy.optOut.statusOptedOut') : $t('legal.privacy.optOut.statusNotOptedOut') }}
      </strong>
      <template v-if="justSaved">
        {{ $t('legal.privacy.optOut.saved') }}
      </template>
    </p>
    <HtFormCheckboxModelled
      id="performance-opt-out"
      v-model="optedOut"
      name="performanceOptOut"
      :label="$t('legal.privacy.optOut.label')"
      @update:model-value="justSaved = false"
    />
    <HtButton
      type="submit"
      color="primary"
    >
      {{ $t('actions.save') }}
    </HtButton>
    <p v-if="mounted">
      <HtTranslate
        v-if="cookieExpiry"
        i18n-key="legal.privacy.optOut.cookieExpiry"
      >
        <template #1>
          <TimestampPreview
            :ts="cookieExpiry"
            :format="MessageTimestampFormat.RELATIVE"
          />
        </template>
      </HtTranslate>
      <template v-else>
        {{ $t('legal.privacy.optOut.cookieLongest') }}
      </template>
    </p>
  </form>
</template>
