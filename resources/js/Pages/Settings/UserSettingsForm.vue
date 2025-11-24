<script setup lang="ts">
import DiscordUserInfo, { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { devModeInject, pagePropsInject } from '@/injection-keys';
import { UserSettings } from '@/model/user-settings';
import ControlledTimeZoneInput from '@/Pages/Settings/ControlledTimeZoneInput.vue';
import FormatComboboxAddon from '@/Pages/Settings/FormatComboboxAddon.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtFormCombobox from '@/Reusable/HtFormCombobox.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import HtFormSubmitButton from '@/Reusable/HtFormSubmitButton.vue';
import HtInput from '@/Reusable/HtInput.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { ComboboxOption } from '@/utils/combobox';
import { LegalSectionIds } from '@/utils/legal';
import { safeRoute } from '@/utils/safe-route';
import {
  faChevronDown,
  faChevronUp,
  faExclamationTriangle,
} from '@fortawesome/free-solid-svg-icons';
import { Link, useForm } from '@inertiajs/vue3';
import { wTrans } from 'laravel-vue-i18n';
import { computed, inject, ref } from 'vue';

export interface UserSettingsFormBotTranslations {
  atCommandName: string;
  at12CommandName: string;
  hourOptionName: string;
  minuteOptionName: string;
  secondOptionName: string;
  formatOptionChoices: Record<string, string>;
  columnsOptionChoices: Record<string, string>;
}

const props = defineProps<{
  entry: {
    user: DiscordUserInfoProps,
    settings: Partial<UserSettings>
  };
  defaultSettings: UserSettings;
  formatOptions?: string[];
  columnsOptions?: string[];
  botTranslations: UserSettingsFormBotTranslations;
}>();

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);
const devMode = inject(devModeInject);
const showAdvancedSettings = ref(false);

const settingsForm = useForm({
  timezone: props.entry.settings.timezone ?? props.defaultSettings.timezone ?? '',
  format: props.entry.settings.format ?? props.formatOptions?.[0] ?? props.defaultSettings.format,
  formatMinimalReply: props.entry.settings.formatMinimalReply ?? props.defaultSettings.formatMinimalReply ?? true,
  ephemeral: props.entry.settings.ephemeral ?? props.defaultSettings.ephemeral ?? true,
  header: props.entry.settings.header ?? props.defaultSettings.header ?? true,
  boldPreview: props.entry.settings.boldPreview ?? props.defaultSettings.boldPreview ?? true,
  columns: props.entry.settings.columns ?? props.formatOptions?.[0] ?? props.defaultSettings.columns,
  telemetry: props.entry.settings.telemetry ?? props.defaultSettings.telemetry ?? true,
  defaultAt12Hour: props.entry.settings.defaultAtHour ?? props.defaultSettings.defaultAt12Hour,
  defaultAtHour: props.entry.settings.defaultAtHour ?? props.defaultSettings.defaultAtHour,
  defaultAtMinute: props.entry.settings.defaultAtMinute ?? props.defaultSettings.defaultAtMinute,
  defaultAtSecond: props.entry.settings.defaultAtSecond ?? props.defaultSettings.defaultAtSecond,
});

const defaultOptionLabelRef = wTrans('botSettings.defaultOption');

const formatComboboxOptions = computed((): ComboboxOption[] => props.formatOptions?.map(columnsOption => ({
  label: columnsOption === 'default' ? defaultOptionLabelRef.value : props.botTranslations.formatOptionChoices[columnsOption],
  value: columnsOption,
})) ?? []);
</script>

<template>
  <HtCard>
    <template #header>
      <DiscordUserInfo v-bind="entry.user" />
    </template>
    <form @submit.prevent="settingsForm.put(route('settings.set', { discordUserId: entry.user.id }))">
      <HtFormControlGroup :vertical="true">
        <HtFormControl
          :id="'timezone-'+entry.user.id"
          :label="$t('botSettings.fields.timezone.displayName')"
          :combo-box="true"
        >
          <ControlledTimeZoneInput
            v-model="settingsForm.timezone"
            name="timezone"
          />
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="settingsForm.errors.timezone"
            />
          </template>
        </HtFormControl>

        <HtFormControl
          v-if="formatOptions"
          :id="'format-'+entry.user.id"
          :label="$t('botSettings.fields.format.displayName')"
          :combo-box="true"
        >
          <HtFormCombobox
            v-model="settingsForm.format"
            name="format"
            class="mt-1"
            :options="formatComboboxOptions"
            :allow-typing="false"
            :addon-component="FormatComboboxAddon"
          />
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="settingsForm.errors.format"
            />
          </template>
        </HtFormControl>

        <HtFormCheckboxModelled
          :id="'formatMinimalReply-'+entry.user.id"
          v-model="settingsForm.formatMinimalReply"
          name="formatMinimalReply"
          :label="$t('botSettings.fields.formatMinimalReply.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="settingsForm.errors.formatMinimalReply"
            />
          </template>
        </HtFormCheckboxModelled>

        <HtFormControl
          v-if="columnsOptions"
          :id="'columns-'+entry.user.id"
          :label="$t('botSettings.fields.columns.displayName')"
        >
          <HtFormSelect
            v-model="settingsForm.columns"
            name="columns"
            class="mt-1"
          >
            <option
              v-for="columnsOption in columnsOptions"
              :key="columnsOption"
              :value="columnsOption"
            >
              {{
                columnsOption === 'default' ? defaultOptionLabelRef : botTranslations.columnsOptionChoices[columnsOption]
              }}
            </option>
          </HtFormSelect>
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="settingsForm.errors.columns"
            />
          </template>
        </HtFormControl>

        <HtFormCheckboxModelled
          :id="'ephemeral-'+entry.user.id"
          v-model="settingsForm.ephemeral"
          name="ephemeral"
          :label="$t('botSettings.fields.ephemeral.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="settingsForm.errors.ephemeral"
            />
          </template>
        </HtFormCheckboxModelled>

        <HtFormCheckboxModelled
          :id="'header-'+entry.user.id"
          v-model="settingsForm.header"
          name="header"
          :label="$t('botSettings.fields.header.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="settingsForm.errors.header"
            />
          </template>
        </HtFormCheckboxModelled>

        <HtFormCheckboxModelled
          :id="'boldPreview-'+entry.user.id"
          v-model="settingsForm.boldPreview"
          name="boldPreview"
          :label="$t('botSettings.fields.boldPreview.displayName')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="settingsForm.errors.boldPreview"
            />
          </template>
        </HtFormCheckboxModelled>

        <HtAlert
          type="info"
          :closable="false"
        >
          <template #text>
            <p class="mb-2">
              <HtTranslate i18n-key="botSettings.fields.telemetry.explanation">
                <template #1>
                  <Link :href="`${safeRoute('legal', route, routeParams)}#${LegalSectionIds.TELEMETRY_STATISTICS}`">
                    {{ $t('global.nav.legal') }}
                  </Link>
                </template>
              </HtTranslate>
            </p>
            <HtFormCheckboxModelled
              :id="'telemetry-'+entry.user.id"
              v-model="settingsForm.telemetry"
              name="telemetry"
              :label="$t('botSettings.fields.telemetry.displayName')"
            >
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="settingsForm.errors.telemetry"
                />
              </template>
            </HtFormCheckboxModelled>
          </template>
        </HtAlert>

        <HtFormControlWrap>
          <HtButton
            color="warning"
            :pressed="showAdvancedSettings"
            :icon-start="faExclamationTriangle"
            :icon-end="showAdvancedSettings ? faChevronUp : faChevronDown"
            @click="showAdvancedSettings = !showAdvancedSettings"
          >
            {{ $t('botSettings.advancedSettings.toggleText') }}
          </HtButton>
          <HtCollapsible :visible="showAdvancedSettings">
            <HtFormControl
              :id="'defaultAt12Hour-'+entry.user.id"
              :label="$t('botSettings.fields.defaultAt12Hour.displayName', {
                at12CommandName: botTranslations.at12CommandName,
                hourOptionName: botTranslations.hourOptionName,
              })"
            >
              <HtInput
                v-model="settingsForm.defaultAt12Hour"
                name="defaultAt12Hour"
                class="mt-1"
                type="number"
                :min="1"
                :max="12"
              />
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="settingsForm.errors.defaultAt12Hour"
                />
              </template>
            </HtFormControl>
            <HtFormControl
              :id="'defaultAtHour-'+entry.user.id"
              :label="$t('botSettings.fields.defaultAtHour.displayName', {
                atCommandName: botTranslations.atCommandName,
                hourOptionName: botTranslations.hourOptionName,
              })"
            >
              <HtInput
                v-model="settingsForm.defaultAtHour"
                name="defaultAtHour"
                class="mt-1"
                type="number"
                :min="0"
                :max="23"
              />
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="settingsForm.errors.defaultAtHour"
                />
              </template>
            </HtFormControl>
            <HtFormControl
              :id="'defaultAtMinute-'+entry.user.id"
              :label="$t('botSettings.fields.defaultAtMinute.displayName', {
                atCommandName: botTranslations.atCommandName,
                minuteOptionName: botTranslations.minuteOptionName,
              })"
            >
              <HtInput
                v-model="settingsForm.defaultAtMinute"
                name="defaultAtMinute"
                class="mt-1"
                type="number"
                :min="0"
                :max="59"
              />
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="settingsForm.errors.defaultAtMinute"
                />
              </template>
            </HtFormControl>
            <HtFormControl
              :id="'defaultAtSecond-'+entry.user.id"
              :label="$t('botSettings.fields.defaultAtSecond.displayName', {
                atCommandName: botTranslations.atCommandName,
                secondOptionName: botTranslations.secondOptionName,
              })"
            >
              <HtInput
                v-model="settingsForm.defaultAtSecond"
                name="defaultAtSecond"
                class="mt-1"
                type="number"
                :min="0"
                :max="59"
              />
              <template #message>
                <FormMessage
                  type="error"
                  class="mt-2"
                  :message="settingsForm.errors.defaultAtSecond"
                />
              </template>
            </HtFormControl>
          </HtCollapsible>
        </HtFormControlWrap>
      </HtFormControlGroup>

      <pre v-if="devMode"><code>{{ JSON.stringify(settingsForm.data(), null, 2) }}</code></pre>

      <HtFormSubmitButton
        :form="settingsForm"
        :success-text="$t('botSettings.saveSuccess')"
      />
    </form>
  </HtCard>
</template>
