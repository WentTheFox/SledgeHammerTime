<script setup lang="ts">
import { Translator } from '@/Components/CrowdinUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { useNativeLocaleNames } from '@/composables/useNativeLocaleNames';
import HtFormCombobox from '@/Reusable/HtFormCombobox.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import { ComboboxOption } from '@/utils/combobox';
import { faUser } from '@fortawesome/free-solid-svg-icons';
import { InertiaForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import AvatarProviderAddon from './AvatarProviderAddon.vue';

const model = defineModel<string | null>();

const props = defineProps<{
  currentLanguage: string;
  translators: Translator[];
  form: InertiaForm<{ sourceLanguage: string|undefined }>
}>();

const nativeLocaleNames = useNativeLocaleNames();

const options = computed(() => props.translators.map((translator): ComboboxOption => ({
  label: nativeLocaleNames[translator.languageCode],
  value: translator.languageCode,
})));
</script>

<template>
  <HtFormControl
    :id="`source-language-${currentLanguage}`"
    :label="$t('profile.creditOverrides.creditSourceLanguage')"
    :label-icon="faUser"
  >
    <HtFormCombobox
      v-model="model"
      :options="options"
      :addon-component="AvatarProviderAddon"
      addon-mode="static"
      :allow-typing="false"
    />
    <template #message>
      <FormMessage
        type="error"
        class="mt-2"
        :message="form.errors.sourceLanguage"
      />
    </template>
  </HtFormControl>
</template>
