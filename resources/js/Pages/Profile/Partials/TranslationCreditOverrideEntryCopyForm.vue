<script setup lang="ts">
import { Translator } from '@/Components/CrowdinUserInfo.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { useNativeLocaleNames } from '@/composables/useNativeLocaleNames';
import { useRoute } from '@/composables/useRoute';
import LanguageCodeAddon from '@/Pages/Profile/Partials/LanguageCodeAddon.vue';
import HtFormCombobox from '@/Reusable/HtFormCombobox.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSubmitButton from '@/Reusable/HtFormSubmitButton.vue';
import { ComboboxOption } from '@/utils/combobox';
import { faCopy, faUser } from '@fortawesome/free-solid-svg-icons';
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const props = defineProps<{
  translator: Translator;
  allTranslators: Translator[];
  ownerCrowdinUserId: string | null;
  discordUsers: DiscordUserInfoProps[];
}>();

const route = useRoute();
const nativeLocaleNames = useNativeLocaleNames();

const formInitValues = computed(() => ({
  sourceLanguage: props.translator.languageCode ?? null,
}));
const copyForm = useForm(formInitValues.value);
watch(formInitValues, (newValues) => {
  copyForm.sourceLanguage = newValues.sourceLanguage;
}, { deep: true });

copyForm.transform(data => ({
  source_language: data.sourceLanguage,
}));

const options = computed(() => props.allTranslators.reduce((acc, t) =>
  t.languageCode !== props.translator.languageCode
    ? [...acc, {
      label: nativeLocaleNames[t.languageCode],
      value: t.languageCode,
    }]
    : acc, [] as ComboboxOption[]));

const overrideRouteParams = computed(() => ({
  crowdinUser: props.ownerCrowdinUserId,
  languageCode: props.translator.languageCode,
}));

const submitOverrideCopy = () => {
  copyForm.put(route('credit-overrides.copy', overrideRouteParams.value), {
    preserveScroll: true,
    preserveState: false
  });
};

watch(() => copyForm.recentlySuccessful, (wasSuccessful) => {
  if (!wasSuccessful) return;
});
</script>

<template>
  <form @submit.prevent="submitOverrideCopy">
    <HtFormControlGroup :vertical="true">
      <HtFormControl
        :id="`source-language-${translator.languageCode}`"
        :label="$t('profile.creditOverrides.creditSourceLanguage')"
        :label-icon="faUser"
      >
        <HtFormCombobox
          v-model="copyForm.sourceLanguage"
          :options="options"
          :addon-component="LanguageCodeAddon"
          :allow-typing="false"
        />
        <template #message>
          <FormMessage
            type="error"
            class="mt-2"
            :message="copyForm.errors.sourceLanguage"
          />
        </template>
      </HtFormControl>
    </HtFormControlGroup>

    <HtFormSubmitButton
      :id="`submit-override-${translator.id}`"
      type="submit"
      color="primary"
      :loading="copyForm.processing"
      :save-icon="faCopy"
      :success-text="$t('profile.creditOverrides.copySuccess')"
      :form="copyForm"
    />
  </form>
</template>
