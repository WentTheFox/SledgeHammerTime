<script setup lang="ts">
import { HourCycle } from '@/classes/DateTimeLibraryLocale';
import FormMessage from '@/Components/FormMessage.vue';
import { localSettingsInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtFormCheckboxControlled from '@/Reusable/HtFormCheckboxControlled.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import { faCaretDown, faCaretUp, faGear } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject, ref } from 'vue';

const settings = inject(localSettingsInject);

const showAdvancedSettings = ref(false);
</script>

<template>
  <section>
    <header>
      <FontAwesomeIcon
        :icon="faGear"
        :fixed-width="true"
      />
      <span class="ms-1">{{ $t('global.sidebar.inputSettings.title') }}</span>
    </header>
    <HtFormControlGroup>
      <HtFormCheckboxControlled
        id="custom-date-input"
        :label="$t('global.sidebar.inputSettings.customDateInput.label')"
        :checked="Boolean(settings?.customDateInputEnabled)"
        @change="settings?.toggleCustomDateInput"
      >
        <template #message>
          <FormMessage
            :message="$t('global.sidebar.inputSettings.customDateInput.description')"
            class="mt-1"
            type="description"
          />
        </template>
      </HtFormCheckboxControlled>
      <HtFormCheckboxControlled
        id="custom-time-input"
        :label="$t('global.sidebar.inputSettings.customTimeInput.label')"
        :checked="Boolean(settings?.customTimeInputEnabled)"
        @change="settings?.toggleCustomTimeInput"
      >
        <template #message>
          <FormMessage
            :message="$t('global.sidebar.inputSettings.customTimeInput.description')"
            class="mt-1"
            type="description"
          />
        </template>
      </HtFormCheckboxControlled>
      <HtFormCheckboxControlled
        id="separate-inputs"
        :label="$t('global.sidebar.inputSettings.separateInputs.label')"
        :checked="!settings?.combinedInputsEnabled"
        @change="settings?.toggleSeparateInputs"
      >
        <template #message>
          <FormMessage
            :message="$t('global.sidebar.inputSettings.separateInputs.description')"
            class="mt-1"
            type="description"
          />
        </template>
      </HtFormCheckboxControlled>
      <HtButton
        :pressed="showAdvancedSettings"
        :icon-end="showAdvancedSettings ? faCaretUp : faCaretDown"
        @click="showAdvancedSettings = !showAdvancedSettings"
      >
        {{ $t('global.sidebar.inputSettings.advancedSettings') }}
      </HtButton>
      <HtCollapsible
        :visible="showAdvancedSettings"
        :animate="false"
      >
        <HtFormCheckboxControlled
          id="nlp-input"
          :label="$t('global.sidebar.inputSettings.naturalLanguageInput.label')"
          :checked="Boolean(settings?.naturalLanguageInputEnabled)"
          :disabled="!settings?.naturalLanguageInputAvailable"
          @change="settings?.toggleNaturalLanguageInput"
        >
          <template #message>
            <FormMessage
              :message="$t('global.sidebar.inputSettings.naturalLanguageInput.description')"
              class="mt-1"
              type="description"
            />
          </template>
        </HtFormCheckboxControlled>
        <HtFormCheckboxControlled
          id="flat-ui"
          :label="$t('global.sidebar.inputSettings.flatUi.label')"
          :checked="Boolean(settings?.flatUiEnabled)"
          @change="settings?.toggleFlatUi"
        >
          <template #message>
            <FormMessage
              :message="$t('global.sidebar.inputSettings.flatUi.description')"
              class="mt-1"
              type="description"
            />
          </template>
        </HtFormCheckboxControlled>
        <HtFormControl
          id="hour-cycle"
          :label="$t('global.sidebar.inputSettings.hourCycle.label')"
        >
          <HtFormSelect
            v-model="settings!.hourCycle"
            @change="settings?.setHourCycle"
          >
            <option :value="null">
              {{ $t('global.sidebar.inputSettings.hourCycle.options.default') }}
            </option>
            <option :value="HourCycle.H12">
              {{ $t('global.sidebar.inputSettings.hourCycle.options.h12') }}
            </option>
            <option :value="HourCycle.H24">
              {{ $t('global.sidebar.inputSettings.hourCycle.options.h24') }}
            </option>
          </HtFormSelect>
          <template #message>
            <FormMessage
              :message="$t('global.sidebar.inputSettings.hourCycle.description')"
              class="mt-1"
              type="description"
            />
          </template>
        </HtFormControl>
      </HtCollapsible>
    </HtFormControlGroup>
  </section>
</template>
