<script setup lang="ts">
import {
  CrowdinUser,
  Translator,
  TranslatorCreditOverride,
  TranslatorCreditOverrideProposal,
} from '@/Components/CrowdinUserInfo.vue';
import { DiscordUser } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { useRoute } from '@/composables/useRoute';
import HtButton from '@/Reusable/HtButton.vue';
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
} from '@fortawesome/free-solid-svg-icons';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import AvatarProviderSelect from './AvatarProviderSelect.vue';

const props = defineProps<{
  translator: Translator;
  ownerCrowdinUser: CrowdinUser | undefined;
  crowdinUsers: CrowdinUser[];
  discordUsers: DiscordUser[];
}>();

const route = useRoute();

const ownerCrowdinUserId = computed(() =>
  props.ownerCrowdinUser ? String(props.ownerCrowdinUser.id) : null,
);

const source = computed((): TranslatorCreditOverrideProposal | TranslatorCreditOverride | null => {
  const proposal = props.translator.proposal;
  if (proposal !== null) return proposal;
  return props.translator.override;
});

const formInitValues = computed(() => ({
  displayName: source.value?.displayName ?? null,
  avatarProvider: source.value?.avatarProvider ?? null,
  avatarId: source.value?.avatarId ?? null,
  url: source.value?.url ?? null,
  hide: props.translator.override?.hide ?? false,
}));
const editForm = useForm(formInitValues.value);
watch(formInitValues, (newValues) => {
  editForm.displayName = newValues.displayName;
  editForm.avatarProvider = newValues.avatarProvider;
  editForm.avatarId = newValues.avatarId;
  editForm.url = newValues.url;
  editForm.hide = newValues.hide;
});

editForm.transform(data => {
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

const isRejected = computed(() => props.translator.proposal?.rejectedAt != null);
const pendingReview = computed(() => props.translator.proposal !== null && !isRejected.value);

const isDefaultCrowdinAvatar = computed(() =>
  ownerCrowdinUserId.value !== null
  && editForm.avatarProvider === 'crowdin'
  && editForm.avatarId === ownerCrowdinUserId.value,
);

const effectiveAvatarProvider = computed(() => isDefaultCrowdinAvatar.value ? null : editForm.avatarProvider);
const effectiveAvatarId = computed(() => isDefaultCrowdinAvatar.value ? null : editForm.avatarId);

const hasChanges = computed(() => {
  const o = props.translator.override;
  return editForm.displayName !== (o?.displayName ?? null)
    || effectiveAvatarProvider.value !== (o?.avatarProvider ?? null)
    || effectiveAvatarId.value !== (o?.avatarId ?? null)
    || editForm.url !== (o?.url ?? null)
    || editForm.hide !== (o?.hide ?? false);
});

const isHideOnlyChange = computed(() => {
  const o = props.translator.override;
  return editForm.displayName === (o?.displayName ?? null)
    && effectiveAvatarProvider.value === (o?.avatarProvider ?? null)
    && effectiveAvatarId.value === (o?.avatarId ?? null)
    && editForm.url === (o?.url ?? null)
    && editForm.hide !== (o?.hide ?? false);
});

const isBlankSubmission = computed(() =>
  !editForm.displayName && !effectiveAvatarProvider.value && !editForm.url,
);

// True when no content field introduces a new non-null value vs the current override,
// i.e. every change is a deletion/clearing, not an addition or modification.
const isDeletionOnlyChange = computed(() => {
  const o = props.translator.override;
  const displayNameIsNew = editForm.displayName !== null && editForm.displayName !== (o?.displayName ?? null);
  const avatarIsNew = effectiveAvatarProvider.value !== null && (
    effectiveAvatarProvider.value !== (o?.avatarProvider ?? null)
    || effectiveAvatarId.value !== (o?.avatarId ?? null)
  );
  const urlIsNew = editForm.url !== null && editForm.url !== (o?.url ?? null);
  return !displayNameIsNew && !avatarIsNew && !urlIsNew;
});

const lastSubmitBypassedApproval = ref<boolean | null>(null);
const bypassesApproval = computed(() => lastSubmitBypassedApproval.value ?? (isHideOnlyChange.value || isBlankSubmission.value || isDeletionOnlyChange.value));

const overrideRouteParams = computed(() => ({
  crowdinUser: ownerCrowdinUserId.value,
  languageCode: props.translator.languageCode,
}));

const submitOverrideEdit = () => {
  lastSubmitBypassedApproval.value = bypassesApproval.value;
  editForm.put(route('credit-overrides.upsert', overrideRouteParams.value), {
    preserveScroll: true,
    preserveState: false
  });
};

const cancelProposal = () => {
  cancelForm.delete(
    route('credit-overrides.cancel-proposal', overrideRouteParams.value),
    {
      preserveScroll: true,
      preserveState: false
    },
  );
};

watch(() => editForm.recentlySuccessful, (recentSuccess) => {
  if (recentSuccess) return;

  lastSubmitBypassedApproval.value = null;
});
</script>

<template>
  <form @submit.prevent="submitOverrideEdit">
    <HtFormControlGroup :vertical="true">
      <HtFormControl
        :id="`displayName-${translator.id}`"
        :label="$t('profile.creditOverrides.displayName')"
        :label-icon="faAddressCard"
      >
        <HtInput
          v-model="editForm.displayName"
          type="text"
          :placeholder="ownerCrowdinUser?.fullName ?? ownerCrowdinUser?.username"
          :disabled="pendingReview || editForm.processing"
          :maxlength="255"
        />
        <template #message>
          <FormMessage
            type="error"
            class="mt-2"
            :message="editForm.errors.displayName"
          />
        </template>
      </HtFormControl>

      <AvatarProviderSelect
        v-model:provider="editForm.avatarProvider"
        v-model:id="editForm.avatarId"
        :translator-id="translator.id"
        :crowdin-users="crowdinUsers"
        :discord-users="discordUsers"
        :default-crowdin-id="ownerCrowdinUserId ?? undefined"
        :disabled="pendingReview || editForm.processing"
        :form="editForm"
      />

      <HtFormControl
        :id="`url-${translator.id}`"
        :label="$t('profile.creditOverrides.url')"
        :label-icon="faLink"
        :full-width="true"
      >
        <HtInput
          :id="`url-${translator.id}`"
          v-model="editForm.url"
          type="url"
          :placeholder="ownerCrowdinUser?.url"
          :disabled="pendingReview || editForm.processing"
          :maxlength="255"
          :full-width="true"
        />
        <template #message>
          <FormMessage
            type="error"
            class="mt-2"
            :message="editForm.errors.url"
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
          :checked="!editForm.hide"
          :disabled="editForm.processing"
          @change="editForm.hide = false"
        />
        <HtFormRadio
          :id="`hide-${translator.id}-hidden`"
          :name="`hide-${translator.id}`"
          :label="$t('profile.creditOverrides.approvedValues.hidden')"
          :checked="editForm.hide"
          :disabled="editForm.processing"
          @change="editForm.hide = true"
        />
      </HtFormControl>
    </HtFormControlGroup>

    <HtFormSubmitButton
      :id="`submit-override-${translator.id}`"
      type="submit"
      color="primary"
      :loading="editForm.processing"
      :save-text="bypassesApproval ? undefined : $t('profile.creditOverrides.submit')"
      :save-icon="bypassesApproval ? undefined : faEnvelopeCircleCheck"
      :success-text="bypassesApproval ? $t('profile.creditOverrides.saveHideSuccess') : $t('profile.creditOverrides.saveSuccess')"
      :disabled="!hasChanges || (pendingReview && !bypassesApproval)"
      :form="editForm"
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
</template>
