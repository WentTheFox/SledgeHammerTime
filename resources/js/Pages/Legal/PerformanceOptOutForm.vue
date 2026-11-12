<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import { isTraceOptedOut, setTraceOptOut } from '@/utils/trace-opt-out';
import { onMounted, ref } from 'vue';

// The cookie is only known in the browser: nothing is shown for SSR, and everything is read once mounted
const mounted = ref(false);
/** What is stored on this device right now, as opposed to the checkbox, which may not be saved yet */
const currentlyOptedOut = ref(false);
const optedOut = ref(false);
const justSaved = ref(false);

onMounted(() => {
  currentlyOptedOut.value = isTraceOptedOut();
  optedOut.value = currentlyOptedOut.value;
  mounted.value = true;
});

const save = () => {
  setTraceOptOut(optedOut.value);
  currentlyOptedOut.value = isTraceOptedOut();
  justSaved.value = true;
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
  </form>
</template>
