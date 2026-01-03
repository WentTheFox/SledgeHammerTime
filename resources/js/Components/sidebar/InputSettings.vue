<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import { localSettingsInject } from '@/injection-keys';
import HtFormCheckboxControlled from '@/Reusable/HtFormCheckboxControlled.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import { faGear } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { inject } from 'vue';

const settings = inject(localSettingsInject);
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
          />
        </template>
      </HtFormCheckboxControlled>
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
          />
        </template>
      </HtFormCheckboxControlled>
    </HtFormControlGroup>
  </section>
</template>
