<script setup lang="ts">
import {
  CreditOverrideValues,
  CrowdinTranslators,
  CrowdinUserInfoProps,
  ProposalValues,
} from '@/Components/CrowdinUserInfo.vue';
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { useNativeLocaleNames } from '@/composables/useNativeLocaleNames';
import { useRoute } from '@/composables/useRoute';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCardFormsSection from '@/Reusable/HtCardFormsSection.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormRadio from '@/Reusable/HtFormRadio.vue';
import HtFormSubmitButton from '@/Reusable/HtFormSubmitButton.vue';
import HtInput from '@/Reusable/HtInput.vue';
import {
  faAddressCard,
  faClockRotateLeft,
  faEnvelopeCircleCheck,
  faEye,
  faLink,
  faTimes,
  faTrash,
} from '@fortawesome/free-solid-svg-icons';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import AvatarProviderSelect from './AvatarProviderSelect.vue';

const props = defineProps<{
  translator: CrowdinTranslators;
  crowdinUsers: CrowdinUserInfoProps[];
  discordUsers: DiscordUserInfoProps[];
}>();

const route = useRoute();

const nativeLocaleNames = useNativeLocaleNames();

const ownerCrowdinUser = computed(() =>
  props.crowdinUsers.find(cu => cu.translators.some(t => t.id === props.translator.id)),
);

const ownerCrowdinUserId = computed(() =>
  ownerCrowdinUser.value ? String(ownerCrowdinUser.value.id) : null,
);

const source = (): ProposalValues | CreditOverrideValues | null => {
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

const cancelForm = useForm({});
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

const isDefaultCrowdinAvatar = computed(() =>
  ownerCrowdinUserId.value !== null
  && form.avatarProvider === 'crowdin'
  && form.avatarId === ownerCrowdinUserId.value,
);

const effectiveAvatarProvider = computed(() => isDefaultCrowdinAvatar.value ? null : form.avatarProvider);
const effectiveAvatarId = computed(() => isDefaultCrowdinAvatar.value ? null : form.avatarId);

const hasChanges = computed(() => {
  const o = props.translator.override;
  return form.displayName !== (o?.displayName ?? null)
    || effectiveAvatarProvider.value !== (o?.avatarProvider ?? null)
    || effectiveAvatarId.value !== (o?.avatarId ?? null)
    || form.url !== (o?.url ?? null)
    || form.hide !== (o?.hide ?? false);
});

const isHideOnlyChange = computed(() => {
  const o = props.translator.override;
  return form.displayName === (o?.displayName ?? null)
    && effectiveAvatarProvider.value === (o?.avatarProvider ?? null)
    && effectiveAvatarId.value === (o?.avatarId ?? null)
    && form.url === (o?.url ?? null)
    && form.hide !== (o?.hide ?? false);
});

const isBlankSubmission = computed(() =>
  !form.displayName && !effectiveAvatarProvider.value && !form.url,
);

// True when no content field introduces a new non-null value vs the current override —
// i.e. every change is a deletion/clearing, not an addition or modification.
const isDeletionOnlyChange = computed(() => {
  const o = props.translator.override;
  const displayNameIsNew = form.displayName !== null && form.displayName !== (o?.displayName ?? null);
  const avatarIsNew = effectiveAvatarProvider.value !== null && (
    effectiveAvatarProvider.value !== (o?.avatarProvider ?? null)
    || effectiveAvatarId.value !== (o?.avatarId ?? null)
  );
  const urlIsNew = form.url !== null && form.url !== (o?.url ?? null);
  return !displayNameIsNew && !avatarIsNew && !urlIsNew;
});

const lastSubmitBypassedApproval = ref<boolean | null>(null);
const bypassesApproval = computed(() => lastSubmitBypassedApproval.value ?? (isHideOnlyChange.value || isBlankSubmission.value || isDeletionOnlyChange.value));

const overrideRouteParams = computed(() => ({
  crowdinUser: ownerCrowdinUserId.value,
  languageCode: props.translator.languageCode,
}));

const submitOverride = () => {
  lastSubmitBypassedApproval.value = bypassesApproval.value;
  form.put(route('credit-overrides.upsert', overrideRouteParams.value), {
    preserveScroll: true,
  });
};

const deleteOverride = () => {
  deleteForm.delete(route('credit-overrides.delete', overrideRouteParams.value), {
    preserveScroll: true,
    onSuccess: () => {
      confirmingDelete.value = false;
    },
  });
};

const cancelProposal = () => {
  cancelForm.delete(
    route('credit-overrides.cancel-proposal', overrideRouteParams.value),
    {
      preserveScroll: true,
      onSuccess: () => {
        const s = source();
        form.displayName = s?.displayName ?? null;
        form.avatarProvider = s?.avatarProvider ?? null;
        form.avatarId = s?.avatarId ?? null;
        form.url = s?.url ?? null;
        form.hide = props.translator.override?.hide ?? false;
        form.clearErrors();
      },
    },
  );
};

watch(() => form.recentlySuccessful, (recentSuccess) => {
  if (recentSuccess) return;

  lastSubmitBypassedApproval.value = null;
})
</script>

<template>
  <HtCardFormsSection>
    <template #header>
      {{ nativeLocaleNames[translator.languageCode] }}

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

    <form @submit.prevent="submitOverride">
      <HtFormControlGroup :vertical="true">
        <HtFormControl
          :id="`displayName-${translator.id}`"
          :label="$t('profile.creditOverrides.displayName')"
          :label-icon="faAddressCard"
        >
          <HtInput
            v-model="form.displayName"
            type="text"
            :placeholder="ownerCrowdinUser?.fullName ?? ownerCrowdinUser?.username"
            :disabled="pendingReview || form.processing"
            :maxlength="255"
          />
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.displayName"
            />
          </template>
        </HtFormControl>

        <AvatarProviderSelect
          v-model:provider="form.avatarProvider"
          v-model:id="form.avatarId"
          :translator-id="translator.id"
          :crowdin-users="crowdinUsers"
          :discord-users="discordUsers"
          :default-crowdin-id="ownerCrowdinUserId ?? undefined"
          :disabled="pendingReview || form.processing"
          :form="form"
        />

        <HtFormControl
          :id="`url-${translator.id}`"
          :label="$t('profile.creditOverrides.url')"
          :label-icon="faLink"
          :full-width="true"
        >
          <HtInput
            :id="`url-${translator.id}`"
            v-model="form.url"
            type="url"
            :placeholder="ownerCrowdinUser?.url"
            :disabled="pendingReview || form.processing"
            :maxlength="255"
            :full-width="true"
          />
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.url"
            />
          </template>
        </HtFormControl>

        <HtFormControl
          :id="`hide-${translator.id}-visible`"
          :label="$t('profile.creditOverrides.visibility')"
          :label-icon="faEye"
        >
          <HtFormRadio
            :id="`hide-${translator.id}-visible`"
            :name="`hide-${translator.id}`"
            :label="$t('profile.creditOverrides.approvedValues.visible')"
            :checked="!form.hide"
            :disabled="form.processing"
            @change="form.hide = false"
          />
          <HtFormRadio
            :id="`hide-${translator.id}-hidden`"
            :name="`hide-${translator.id}`"
            :label="$t('profile.creditOverrides.approvedValues.hidden')"
            :checked="form.hide"
            :disabled="form.processing"
            @change="form.hide = true"
          />
        </HtFormControl>
      </HtFormControlGroup>

      <HtFormSubmitButton
        :id="`submit-override-${translator.id}`"
        type="submit"
        color="primary"
        :loading="form.processing"
        :save-text="bypassesApproval ? undefined : $t('profile.creditOverrides.submit')"
        :save-icon="bypassesApproval ? undefined : faEnvelopeCircleCheck"
        :success-text="bypassesApproval ? $t('profile.creditOverrides.saveHideSuccess') : $t('profile.creditOverrides.saveSuccess')"
        :disabled="!hasChanges || (pendingReview && !bypassesApproval)"
        :form="form"
      >
        <HtButton
          v-if="translator.proposal !== null"
          type="button"
          color="warning"
          :loading="cancelForm.processing"
          :icon-start="faClockRotateLeft"
          @click="cancelProposal"
        >
          {{ $t('profile.creditOverrides.cancel') }}
        </HtButton>
      </HtFormSubmitButton>
    </form>

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
