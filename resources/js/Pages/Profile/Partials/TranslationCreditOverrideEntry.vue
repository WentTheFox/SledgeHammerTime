<script setup lang="ts">
import {
  CrowdinUserInfoProps,
  Translator,
  TranslatorCreditOverride,
  TranslatorCreditOverrideProposal,
} from '@/Components/CrowdinUserInfo.vue';
import { DiscordUser } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { useNativeLocaleNames } from '@/composables/useNativeLocaleNames';
import { useRoute } from '@/composables/useRoute';
import TranslationCreditOverrideEntryCopyForm
  from '@/Pages/Profile/Partials/TranslationCreditOverrideEntryCopyForm.vue';
import TranslationCreditOverrideEntryEditForm
  from '@/Pages/Profile/Partials/TranslationCreditOverrideEntryEditForm.vue';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCardFormsSection from '@/Reusable/HtCardFormsSection.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormRadio from '@/Reusable/HtFormRadio.vue';
import { faTimes, faTrash } from '@fortawesome/free-solid-svg-icons';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps<{
  translator: Required<Translator>;
  allTranslators: Required<Translator>[];
  crowdinUsers: CrowdinUserInfoProps[];
  discordUsers: DiscordUser[];
}>();

const route = useRoute();

const nativeLocaleNames = useNativeLocaleNames();

const ownerCrowdinUser = computed(() =>
  props.crowdinUsers.find(cu => cu.translators?.some(t => t.id === props.translator.id)),
);

const ownerCrowdinUserId = computed(() =>
  ownerCrowdinUser.value ? String(ownerCrowdinUser.value.id) : null,
);

const source = (): TranslatorCreditOverrideProposal | TranslatorCreditOverride | null => {
  const proposal = props.translator.proposal;
  if (proposal !== null) return proposal;
  return props.translator.override;
};

const form = useForm({
  displayName: source()?.displayName ?? null,
  avatarProvider: source()?.avatarProvider ?? null,
  avatarId: source()?.avatarId ?? null,
  url: source()?.url ?? null,
  hide: props.translator.override?.hide ?? false,
});

form.transform(data => {
  const isDefaultCrowdin = ownerCrowdinUserId.value !== null
    && data.avatarProvider === 'crowdin'
    && data.avatarId === ownerCrowdinUserId.value;
  return {
    display_name: data.displayName,
    avatar_provider: isDefaultCrowdin ? null : data.avatarProvider,
    avatar_id: isDefaultCrowdin ? null : data.avatarId,
    url: data.url,
    hide: data.hide,
  };
});

const deleteForm = useForm({});
const confirmingDelete = ref(false);

const isRejected = computed(() => props.translator.proposal?.rejectedAt != null);
const pendingReview = computed(() => props.translator.proposal !== null && !isRejected.value);

const approvedAvatarCrowdinUser = computed(() => {
  const o = props.translator.override;
  if (o?.avatarProvider !== 'crowdin' || !o.avatarId) return null;
  return props.crowdinUsers.find(u => String(u.id) === o.avatarId) ?? null;
});

const approvedAvatarDiscordUser = computed(() => {
  const o = props.translator.override;
  if (o?.avatarProvider !== 'discord' || !o.avatarId) return null;
  return props.discordUsers.find(u => u.id === o.avatarId) ?? null;
});

const lastSubmitBypassedApproval = ref<boolean | null>(null);

const overrideRouteParams = computed(() => ({
  crowdinUser: ownerCrowdinUserId.value,
  languageCode: props.translator.languageCode,
}));

const deleteOverride = () => {
  deleteForm.delete(route('credit-overrides.delete', overrideRouteParams.value), {
    preserveScroll: true,
    preserveState: false,
    onSuccess: () => {
      confirmingDelete.value = false;
    },
  });
};

watch(() => form.recentlySuccessful, (recentSuccess) => {
  if (recentSuccess) return;

  lastSubmitBypassedApproval.value = null;
});

const selectedUpdateMethod = ref<'copy' | 'edit'>('edit');
</script>

<template>
  <HtCardFormsSection>
    <template #header>
<!--
      TODO Show crowdin user image and name with tooltip
      <CrowdinUserInfo
        v-bind="translator.crowdinUser"
        :avatar-only="true"
      />
      -->{{ nativeLocaleNames[translator.languageCode] }} ({{ translator.languageCode }})<!--
      -->
      <HtBadge
        v-if="translator.override || translator.proposal"
        class="credit-override-status ms-2"
        :color="isRejected ? 'red' : (pendingReview ? 'yellow' : 'green')"
      >
        <template #prefix>
          {{ $t('profile.creditOverrides.statusPrefix') }}
        </template>
        {{
          isRejected
            ? $t('profile.creditOverrides.status.rejected')
            : (pendingReview
              ? $t('profile.creditOverrides.status.inReview')
              : $t('profile.creditOverrides.status.approved'))
        }}
      </HtBadge>
    </template>

    <HtAlert
      v-if="translator.override !== null"
      type="info"
      class="credit-override-approved-values"
      :closable="false"
    >
      <template #title>
        {{ $t('profile.creditOverrides.currentlyApproved') }}
      </template>
      <template #text>
        <p v-if="translator.override.displayName">
          <strong>{{ $t('profile.creditOverrides.approvedValues.displayName') }}:</strong>
          {{ translator.override.displayName }}
        </p>
        <p v-if="translator.override.avatarProvider">
          <strong>{{ $t('profile.creditOverrides.approvedValues.avatarProvider') }}:</strong>
          {{ $t(`profile.creditOverrides.avatarProviders.${translator.override.avatarProvider}`) }}
          <template v-if="approvedAvatarCrowdinUser">
            ({{ approvedAvatarCrowdinUser.fullName ?? approvedAvatarCrowdinUser.username }})
          </template>
          <template v-else-if="approvedAvatarDiscordUser">
            ({{ approvedAvatarDiscordUser.name }})
          </template>
          <template v-else-if="translator.override.avatarId">
            ({{ translator.override.avatarId }})
          </template>
        </p>
        <p v-if="translator.override.url">
          <strong>{{ $t('profile.creditOverrides.approvedValues.url') }}:</strong>
          {{ translator.override.url }}
        </p>
        <p>
          <strong>{{ $t('profile.creditOverrides.visibility') }}:</strong>
          {{
            translator.override.hide
              ? $t('profile.creditOverrides.approvedValues.hidden')
              : $t('profile.creditOverrides.approvedValues.visible')
          }}
        </p>
      </template>
    </HtAlert>

    <HtFormControl
      v-if="allTranslators.length > 1"
      :id="`update-method-${translator.id}`"
      :label="$t('profile.creditOverrides.updateMethodLabel')"
    >
      <HtFormRadio
        :id="`update-method-${translator.id}-edit`"
        :name="`update-method-${translator.id}`"
        value="edit"
        :label="$t(`profile.creditOverrides.updateMethodEditLabel`)"
        :checked="selectedUpdateMethod === 'edit'"
        @change="selectedUpdateMethod = 'edit'"
      />
      <HtFormRadio
        :id="`update-method-${translator.id}-copy`"
        :name="`update-method-${translator.id}`"
        value="copy"
        :label="$t(`profile.creditOverrides.updateMethodCopyLabel`)"
        :checked="selectedUpdateMethod === 'copy'"
        @change="selectedUpdateMethod = 'copy'"
      />
      <template #message>
        <FormMessage
          type="description"
          class="mt-1"
          :message="$t('profile.creditOverrides.updateMethodDescription')"
        />
      </template>
    </HtFormControl>
    <HtCollapsible :visible="selectedUpdateMethod === 'copy'">
      <TranslationCreditOverrideEntryCopyForm
        :translator="translator"
        :all-translators="allTranslators"
        :crowdin-users="crowdinUsers"
        :discord-users="discordUsers"
        :owner-crowdin-user-id="ownerCrowdinUserId"
      />
    </HtCollapsible>
    <HtCollapsible :visible="selectedUpdateMethod === 'edit'">
      <TranslationCreditOverrideEntryEditForm
        :translator="translator"
        :crowdin-users="crowdinUsers"
        :discord-users="discordUsers"
        :owner-crowdin-user="ownerCrowdinUser"
      />
    </HtCollapsible>

    <div
      v-if="translator.override !== null"
      class="credit-override-delete mt-3"
    >
      <HtButton
        color="danger"
        :icon-start="faTrash"
        :pressed="confirmingDelete"
        :disabled="confirmingDelete"
        @click="confirmingDelete = true"
      >
        {{ $t('profile.creditOverrides.deleteOverride') }}
      </HtButton>
      <HtCollapsible :visible="confirmingDelete">
        <p class="mb-3">
          {{ $t('profile.creditOverrides.deleteOverrideConfirm') }}
        </p>

        <div>
          <HtButton
            class="me-3"
            :icon-start="faTimes"
            @click="confirmingDelete = false"
          >
            {{ $t('actions.cancel') }}
          </HtButton>

          <HtButton
            color="danger"
            :disabled="deleteForm.processing"
            :aria-busy="deleteForm.processing ? 'true' : undefined"
            :icon-start="faTrash"
            @click="deleteOverride"
          >
            {{ $t('actions.confirm') }}
          </HtButton>
        </div>
      </HtCollapsible>
    </div>
  </HtCardFormsSection>
</template>
