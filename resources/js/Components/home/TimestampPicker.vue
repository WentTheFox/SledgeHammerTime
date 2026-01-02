<script setup lang="ts">
import CustomDateInput from '@/Components/home/inputs/CustomDateInput.vue';
import CustomDateTimeInput from '@/Components/home/inputs/CustomDateTimeInput.vue';
import CustomTimeInput from '@/Components/home/inputs/CustomTimeInput.vue';
import InputSelector from '@/Components/home/inputs/InputSelector.vue';
import NativeDateInput from '@/Components/home/inputs/NativeDateInput.vue';
import NativeDateTimeInput from '@/Components/home/inputs/NativeDateTimeInput.vue';
import NativeTimeInput from '@/Components/home/inputs/NativeTimeInput.vue';
import TimeZonePicker from '@/Components/home/inputs/TimeZoneInput.vue';
import { localSettingsInject, timestampInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { faClockRotateLeft, faLock, faLockOpen } from '@fortawesome/free-solid-svg-icons';
import { computed, inject } from 'vue';
import { Tippy } from 'vue-tippy';

const ts = inject(timestampInject);
const settings = inject(localSettingsInject);

const displayCombinedInput = computed(() => Boolean(settings?.combinedInputsEnabled || !settings?.customDateInputEnabled));
const displayCustomCombinedInput = computed(() => Boolean(settings?.customDateInputEnabled || settings?.customTimeInputEnabled));
</script>

<template>
  <HtFormControlGroup>
    <template v-if="displayCombinedInput">
      <HtFormControl
        id="datetimepicker"
        :label="$t('timestampPicker.picker.label.dateAndTime')"
      >
        <InputSelector
          :custom-input-enabled="displayCustomCombinedInput"
          :custom-impl="CustomDateTimeInput"
          :native-impl="NativeDateTimeInput"
          :disabled="ts?.isLocked.value"
        />
      </HtFormControl>
    </template>
    <template v-else>
      <HtFormControl
        id="datepicker"
        :label="$t('timestampPicker.picker.label.date')"
      >
        <InputSelector
          :custom-input-enabled="settings?.customDateInputEnabled"
          :custom-impl="CustomDateInput"
          :native-impl="NativeDateInput"
          :disabled="ts?.isLocked.value"
        />
      </HtFormControl>
      <HtFormControl
        id="timepicker"
        :label="$t('timestampPicker.picker.label.time')"
      >
        <InputSelector
          :custom-input-enabled="settings?.customTimeInputEnabled"
          :custom-impl="CustomTimeInput"
          :native-impl="NativeTimeInput"
          :disabled="ts?.isLocked.value"
        />
      </HtFormControl>
    </template>
    <HtFormControl
      id="timezonepicker"
      :label="$t('timestampPicker.picker.label.timezone')"
    >
      <TimeZonePicker :disabled="ts?.isLocked.value" />
    </HtFormControl>
    <div
      v-if="ts"
      class="form-control form-control-buttons pt-4"
    >
      <Tippy>
        <HtButton
          :disabled="ts.isLocked.value"
          :icon-start="faClockRotateLeft"
          :icon-only="true"
          @click="ts.setCurrentTime"
        />
        <template #content>
          {{ $t('timestampPicker.picker.tooltip.setToCurrent') }}
        </template>
      </Tippy>
      <Tippy v-if="ts.isLocked.value">
        <HtLinkButton
          color="danger"
          :icon-start="faLockOpen"
          :icon-only="true"
          :href="ts.unlockedTimestampUrl.value"
          @click.prevent="ts.unlock"
        />
        <template #content>
          {{ $t('timestampPicker.picker.tooltip.unlock') }}
        </template>
      </Tippy>
      <Tippy v-else>
        <HtLinkButton
          color="primary"
          :icon-start="faLock"
          :icon-only="true"
          :href="ts.lockedTimestampUrl.value"
          @click.prevent="ts.lock"
        />
        <template #content>
          {{ $t('timestampPicker.picker.tooltip.lock') }}
        </template>
      </Tippy>
    </div>
  </HtFormControlGroup>
</template>
