<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { useRecentlySuccessful } from '@/composables/useRecentlySuccessful';
import { dateTimeLibraryInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSubmitButton from '@/Reusable/HtFormSubmitButton.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { getTraceOptOutExpiry, isTraceOptedOut, setTraceOptOut } from '@/utils/trace-opt-out';
import { useForm } from '@inertiajs/vue3';
import { computed, inject, onMounted, ref } from 'vue';

// The cookie is only known in the browser: nothing is shown for SSR, and everything is read once mounted
const mounted = ref(false);
/** What is stored on this device right now, as opposed to the checkbox, which may not be saved yet */
const currentlyOptedOut = ref(false);
const dtl = inject(dateTimeLibraryInject);
/** The expiry the browser reports for the cookie, which can be sooner than what was asked for */
const cookieExpiresAt = ref<number | null>(null);
const cookieExpiry = computed(() => cookieExpiresAt.value === null ? undefined : dtl?.value.fromTimestampMsUtc(cookieExpiresAt.value));
const optOutForm = useForm({ performanceOptOut: false });
// Saving sets a cookie and sends no request, so Inertia does not clear the flag on its own
const markRecentlySuccessful = useRecentlySuccessful();

const readCookieExpiry = async () => {
  cookieExpiresAt.value = currentlyOptedOut.value ? await getTraceOptOutExpiry() : null;
};

onMounted(async () => {
  currentlyOptedOut.value = isTraceOptedOut();
  // Making the stored choice the form's pristine state (not just its current value) leaves the form unchanged, as if
  // it had been created with it: the cookie is only readable in the browser, so it cannot be an initial value
  optOutForm.defaults({ performanceOptOut: currentlyOptedOut.value }).reset();
  mounted.value = true;
  await readCookieExpiry();
});

const save = async () => {
  setTraceOptOut(optOutForm.data().performanceOptOut);
  currentlyOptedOut.value = isTraceOptedOut();
  markRecentlySuccessful(optOutForm);
  await readCookieExpiry();
};
</script>

<template>
  <form
    class="performance-opt-out-form"
    @submit.prevent="save"
  >
    <HtAlert
      type="info"
      :closable="false"
    >
      <template #text>
        <p
          v-if="mounted"
          role="status"
        >
          <strong>
            {{ currentlyOptedOut ? $t('legal.privacy.optOut.statusOptedOut') : $t('legal.privacy.optOut.statusNotOptedOut') }}
          </strong>
        </p>
        <HtFormControlGroup>
          <HtFormCheckboxModelled
            id="performance-opt-out"
            v-model="optOutForm.performanceOptOut"
            name="performanceOptOut"
            :label="$t('legal.privacy.optOut.label')"
          />
        </HtFormControlGroup>
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
      </template>
      <template #actions>
        <HtFormSubmitButton
          id="opt-out-save"
          :success-text="$t('legal.privacy.optOut.saved')"
          :form="optOutForm"
        />
      </template>
    </HtAlert>
  </form>
</template>

<style lang="scss" scoped>
@use "../../../css/design";

.performance-opt-out-form {
  margin-bottom: .5rem;

  @include design.base-font;

  @media print {
    display: none;
  }
}
</style>
