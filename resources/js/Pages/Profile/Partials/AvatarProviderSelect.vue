<script setup lang="ts">
import { CrowdinUser } from '@/Components/CrowdinUserInfo.vue';
import { DiscordUser } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { avatarUrlMapInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtFormCombobox from '@/Reusable/HtFormCombobox.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormRadio from '@/Reusable/HtFormRadio.vue';
import HtInput from '@/Reusable/HtInput.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { AVATAR_PROVIDERS, avatarEmailToHash, AvatarProviderName } from '@/utils/avatarUri';
import { ComboboxOption } from '@/utils/combobox';
import { faCircleUser } from '@fortawesome/free-regular-svg-icons';
import { faAt, faRotateLeft, faUser } from '@fortawesome/free-solid-svg-icons';
import { InertiaForm } from '@inertiajs/vue3';
import { computed, provide, ref, watch } from 'vue';
import AvatarProviderAddon from './AvatarProviderAddon.vue';

const providerModel = defineModel<string | null>('provider', { default: null });
const idModel = defineModel<string | null>('id', { default: null });

const props = defineProps<{
  translatorId: string;
  crowdinUsers: CrowdinUser[];
  discordUsers: DiscordUser[];
  defaultCrowdinId?: string;
  disabled?: boolean;
  form: InertiaForm<{ avatarProvider: string | null; avatarId: string | null }>;
}>();

const selectedProvider = ref<AvatarProviderName | null>(null);
const selectedAccountId = ref<string | null>(null);
// Retained hash: set from existing URI on init, or computed from email input
const avatarHash = ref<string | undefined>(undefined);
const avatarEmail = ref('');

function initFromParts(provider: string | null, id: string | null) {
  if (provider === 'gravatar' || provider === 'libravatar') {
    selectedProvider.value = provider;
    avatarHash.value = id ?? undefined;
    selectedAccountId.value = null;
    avatarEmail.value = '';
  } else {
    selectedProvider.value = AVATAR_PROVIDERS.find(v => v === provider) ?? (props.defaultCrowdinId ? 'crowdin' : null);
    selectedAccountId.value = id ?? props.defaultCrowdinId ?? null;
    avatarHash.value = undefined;
    avatarEmail.value = '';
  }
}

initFromParts(providerModel.value, idModel.value);

const computedId = computed((): string | null => {
  if (!selectedProvider.value) return null;
  if (selectedProvider.value === 'gravatar' || selectedProvider.value === 'libravatar') {
    return avatarHash.value ?? null;
  }
  return selectedAccountId.value;
});

// Propagate internal state changes to models
watch([selectedProvider, computedId], ([p, i]) => {
  providerModel.value = p;
  idModel.value = i;
});

// React to external model resets (e.g. cancel proposal)
watch([providerModel, idModel], ([newProvider, newId]) => {
  if (newProvider !== selectedProvider.value || newId !== computedId.value) {
    initFromParts(newProvider, newId);
  }
});

watch(avatarEmail, (email) => {
  const trimmed = email.trim();
  if (trimmed) {
    avatarHash.value = avatarEmailToHash(trimmed);
  }
});

function onProviderChange(provider: AvatarProviderName) {
  if (selectedProvider.value !== provider) {
    selectedProvider.value = provider;
    selectedAccountId.value = null;
  }
}

const isDefaultCrowdinAvatar = computed(() =>
  props.defaultCrowdinId !== undefined
  && selectedProvider.value === 'crowdin'
  && selectedAccountId.value === props.defaultCrowdinId,
);

function resetToDefaultCrowdin() {
  selectedProvider.value = 'crowdin';
  selectedAccountId.value = props.defaultCrowdinId ?? null;
}

const discordOptions = computed((): ComboboxOption[] =>
  props.discordUsers.map(u => ({
    label: u.name,
    value: u.id,
    description: u.id,
  })),
);

const crowdinOptions = computed((): ComboboxOption[] =>
  props.crowdinUsers.map(u => ({
    label: u.fullName ?? u.username,
    value: String(u.id),
    description: String(u.id),
  })),
);

const activeOptions = computed((): ComboboxOption[] => {
  if (selectedProvider.value === 'discord') return discordOptions.value;
  if (selectedProvider.value === 'crowdin') return crowdinOptions.value;
  return [];
});

const avatarUrlMap = computed((): Record<AvatarProviderName, Record<string, string> | null> => ({
  discord: props.discordUsers.reduce((acc, u) => ({ ...acc, [u.id]: u.avatarUrl }), {}),
  crowdin: props.crowdinUsers.reduce((acc, u) => ({ ...acc, [u.id]: u.avatarUrl }), {}),
  gravatar: null,
  libravatar: null,
}));

const providedAvatarUrlMap = computed((): Record<string, string> => {
  return (selectedProvider.value && avatarUrlMap.value?.[selectedProvider.value]) ?? {};
});

provide(avatarUrlMapInject, providedAvatarUrlMap);
</script>

<template>
  <HtFormControl
    :id="`avatar-provider-${translatorId}`"
    :label="$t('profile.creditOverrides.avatarProvider')"
    :label-icon="faCircleUser"
  >
    <HtFormRadio
      v-for="provider in (['discord', 'gravatar', 'libravatar', 'crowdin'] as AvatarProviderName[])"
      :id="`avatar-provider-${translatorId}-${provider}`"
      :key="provider"
      :name="`avatar-provider-${translatorId}`"
      :value="provider"
      :label="$t(`profile.creditOverrides.avatarProviders.${provider}`)"
      :checked="selectedProvider === provider"
      :disabled="disabled"
      @change="onProviderChange(provider)"
    />
  </HtFormControl>

  <HtFormControl
    v-if="selectedProvider === 'gravatar' || selectedProvider === 'libravatar'"
    :id="`avatar-email-${translatorId}`"
    :label="$t('profile.creditOverrides.gravatarEmail')"
    :label-icon="faAt"
    :full-width="true"
  >
    <HtInput
      v-model="avatarEmail"
      type="text"
      inputmode="email"
      class="mt-1"
      :placeholder="avatarHash"
      :disabled="disabled"
      :full-width="true"
    />
    <template #message>
      <FormMessage type="description">
        <template #message>
          <HtTranslate
            v-if="selectedProvider === 'gravatar'"
            i18n-key="profile.creditOverrides.gravatarDescription"
          >
            <template #1="slotProps">
              <HtExternalLink href="https://gravatar.com/">
                {{ slotProps.text }}
              </HtExternalLink>
            </template>
          </HtTranslate>
          <HtTranslate
            v-if="selectedProvider === 'libravatar'"
            i18n-key="profile.creditOverrides.libravatarDescription"
          >
            <template #1="slotProps">
              <HtExternalLink href="https://libravatar.org/">
                {{ slotProps.text }}
              </HtExternalLink>
            </template>
          </HtTranslate>
        </template>
      </FormMessage>
    </template>
  </HtFormControl>

  <HtFormControl
    v-else-if="selectedProvider === 'discord' || selectedProvider === 'crowdin'"
    :id="`avatar-account-${translatorId}`"
    :label="$t('profile.creditOverrides.avatarAccount')"
    :label-icon="faUser"
  >
    <HtFormCombobox
      v-model="selectedAccountId"
      :options="activeOptions"
      :addon-component="AvatarProviderAddon"
      addon-mode="static"
      :allow-typing="false"
      :disabled="disabled"
    />
    <template #message>
      <FormMessage
        type="error"
        class="mt-2"
        :message="form.errors.avatarProvider"
      />
      <FormMessage
        type="error"
        class="mt-2"
        :message="form.errors.avatarId"
      />
    </template>
  </HtFormControl>

  <HtButton
    v-if="defaultCrowdinId !== undefined"
    type="button"
    class="mt-1"
    :icon-start="faRotateLeft"
    :disabled="disabled || isDefaultCrowdinAvatar"
    @click="resetToDefaultCrowdin"
  >
    {{ $t('actions.restore') }}
  </HtButton>
</template>
