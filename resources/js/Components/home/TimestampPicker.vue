<script setup lang="ts">
import CustomDateInput from '@/Components/home/inputs/CustomDateInput.vue';
import CustomDateTimeInput from '@/Components/home/inputs/CustomDateTimeInput.vue';
import CustomTimeInput from '@/Components/home/inputs/CustomTimeInput.vue';
import InputSelector from '@/Components/home/inputs/InputSelector.vue';
import NativeDateInput from '@/Components/home/inputs/NativeDateInput.vue';
import NativeDateTimeInput from '@/Components/home/inputs/NativeDateTimeInput.vue';
import NativeTimeInput from '@/Components/home/inputs/NativeTimeInput.vue';
import TimeZonePicker from '@/Components/home/inputs/TimeZoneInput.vue';
import { devModeInject, localSettings, timestamp } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import { faClockRotateLeft, faLock, faLockOpen } from '@fortawesome/free-solid-svg-icons';
import { inject } from 'vue';
import { Tippy } from 'vue-tippy';

const ts = inject(timestamp);
const settings = inject(localSettings);
const devMode = inject(devModeInject);
</script>

<template>
  <HtFormControlGroup>
    <template v-if="settings?.combinedInputsEnabled">
      <HtFormControl
        id="datetimepicker"
        :label="$t('timestampPicker.picker.label.dateAndTime')"
      >
        <InputSelector
          :custom-input-enabled="settings?.customInputEnabled"
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
          :custom-input-enabled="settings?.customInputEnabled"
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
          :custom-input-enabled="settings?.customInputEnabled"
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
      <template v-if="devMode || ts.isLocked.value">
        <Tippy v-if="ts.isLocked.value">
          <HtButton
            color="danger"
            :icon-start="faLockOpen"
            :icon-only="true"
            @click="ts.unlock"
          />
          <template #content>
            {{ $t('timestampPicker.picker.tooltip.unlock') }}
          </template>
        </Tippy>
        <Tippy v-else>
          <HtButton
            color="primary"
            :icon-start="faLock"
            :icon-only="true"
            @click="ts.lock"
          />
          <template #content>
            {{ $t('timestampPicker.picker.tooltip.lock') }}
          </template>
        </Tippy>
      </template>
    </div>
  </HtFormControlGroup>
</template>
