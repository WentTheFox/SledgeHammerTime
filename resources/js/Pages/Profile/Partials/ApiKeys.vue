<script setup lang="ts">
import { DiscordUserInfoProps } from '@/Components/DiscordUserInfo.vue';
import FormMessage from '@/Components/FormMessage.vue';
import { useRoute } from '@/composables/useRoute';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCopyableText from '@/Reusable/HtCopyableText.vue';
import HtFormCheckboxControlled from '@/Reusable/HtFormCheckboxControlled.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import HtFormSubmitButton from '@/Reusable/HtFormSubmitButton.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { faArrowsRotate, faTimes, faTrash } from '@fortawesome/free-solid-svg-icons';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, nextTick, ref, useTemplateRef, watch } from 'vue';

export interface ApiKeyInfo {
  id: string;
  name: string;
  discordUserId: string;
  scopes: string[];
  createdAt: string;
  lastUsedAt: string | null;
  expiresAt: string | null;
}

interface NewApiKey {
  id: string;
  name: string;
  token: string;
}

/**
 * Must match StoreApiKeyRequest::EXPIRY_DAYS
 */
const EXPIRY_DAYS = [30, 90, 365];

const props = defineProps<{
  apiKeys: ApiKeyInfo[];
  scopes: string[];
  maxKeys: number;
  discordUsers: DiscordUserInfoProps[];
}>();

const route = useRoute();
const page = usePage();

// Flashed by the server after creating a key, so it is only there for the one response that follows
const newKey = computed<NewApiKey | null>(() => {
  const flashed = page.flash?.newApiKey as Partial<NewApiKey> | undefined;
  return typeof flashed?.token === 'string' ? flashed as NewApiKey : null;
});

const newKeyAlert = useTemplateRef<HTMLElement>('new-key-alert');

// The key is shown by the form, and the page keeps its scroll position, so bring it into view
watch(newKey, async (value) => {
  if (!value) {
    return;
  }
  await nextTick();
  newKeyAlert.value?.scrollIntoView({ block: 'center', behavior: 'smooth' });
});

const form = useForm({
  name: '',
  discord_user_id: props.discordUsers[0]?.id ?? '',
  scopes: ['timestamps:create'] as string[],
  expires_in_days: 90 as number | null,
});

const submit = () => {
  form.post(route('api-keys.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset('name'),
  });
};

const handleScopeChange = (e: Event) => {
  const target = e.target;
  if (!(target instanceof HTMLInputElement)) {
    return;
  }

  form.scopes = target.checked
    ? [...form.scopes, target.value]
    : form.scopes.filter(scope => scope !== target.value);
};

const accountName = (discordUserId: string) => props.discordUsers.find(user => user.id === discordUserId)?.name ?? discordUserId;

// A plain UTC date, so what the server rendered is exactly what the browser shows
const formatDate = (iso: string) => iso.slice(0, 10);

const isExpired = (key: ApiKeyInfo) => key.expiresAt !== null && new Date(key.expiresAt).getTime() <= Date.now();

const actionForm = useForm({});
const confirming = ref<{ id: string; action: 'rotate' | 'revoke' } | null>(null);

const runAction = (key: ApiKeyInfo, action: 'rotate' | 'revoke') => {
  const options = {
    preserveScroll: true,
    onFinish: () => {
      confirming.value = null;
    },
  };
  if (action === 'rotate') {
    actionForm.post(route('api-keys.rotate', { tokenId: key.id }), options);
  } else {
    actionForm.delete(route('api-keys.destroy', { tokenId: key.id }), options);
  }
};

const canCreate = computed(() => props.discordUsers.length > 0 && props.apiKeys.length < props.maxKeys);
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('profile.apiKeys.heading') }}</h2>
    </template>

    <p class="mt-1 mb-3">
      {{ $t('profile.apiKeys.description') }}
    </p>

    <p
      v-if="apiKeys.length === 0"
      class="mb-3"
    >
      {{ $t('profile.apiKeys.none') }}
    </p>
    <ul
      v-else
      class="api-keys mb-3"
    >
      <li
        v-for="key of apiKeys"
        :key="key.id"
        class="api-key mb-3"
      >
        <div>
          <strong>{{ key.name }}</strong>
          <HtBadge
            v-for="scope of key.scopes"
            :key="scope"
            class="ms-1"
          >
            {{ $t(`profile.apiKeys.scopes.${scope}`) }}
          </HtBadge>
          <HtBadge
            v-if="isExpired(key)"
            color="danger"
            class="ms-1"
          >
            {{ $t('profile.apiKeys.list.expired') }}
          </HtBadge>
        </div>
        <div>
          {{ $t('profile.apiKeys.list.actsAs') }}: {{ accountName(key.discordUserId) }}
          · {{ $t('profile.apiKeys.list.createdAt') }}: {{ formatDate(key.createdAt) }}
          · {{ $t('profile.apiKeys.list.lastUsedAt') }}:
          {{ key.lastUsedAt ? formatDate(key.lastUsedAt) : $t('profile.apiKeys.list.neverUsed') }}
          <template v-if="key.expiresAt">
            · {{ $t('profile.apiKeys.list.expiresAt') }}: {{ formatDate(key.expiresAt) }}
          </template>
        </div>
        <div class="mt-1">
          <template v-if="confirming?.id !== key.id">
            <HtButton
              class="me-3"
              :icon-start="faArrowsRotate"
              @click="confirming = { id: key.id, action: 'rotate' }"
            >
              {{ $t('profile.apiKeys.list.rotate') }}
            </HtButton>
            <HtButton
              color="danger"
              :icon-start="faTrash"
              @click="confirming = { id: key.id, action: 'revoke' }"
            >
              {{ $t('profile.apiKeys.list.revoke') }}
            </HtButton>
          </template>
          <template v-else>
            <p class="mb-2">
              {{ $t(`profile.apiKeys.list.${confirming.action}Confirm`, { name: key.name }) }}
            </p>
            <HtButton
              class="me-3"
              :icon-start="faTimes"
              @click="confirming = null"
            >
              {{ $t('actions.cancel') }}
            </HtButton>
            <HtButton
              :color="confirming.action === 'revoke' ? 'danger' : undefined"
              :disabled="actionForm.processing"
              :aria-busy="actionForm.processing ? 'true' : undefined"
              :icon-start="confirming.action === 'revoke' ? faTrash : faArrowsRotate"
              @click="runAction(key, confirming.action)"
            >
              {{ $t('actions.confirm') }}
            </HtButton>
          </template>
        </div>
      </li>
    </ul>

    <div
      v-if="newKey"
      ref="new-key-alert"
    >
      <HtAlert
        type="warning"
        :closable="false"
        class="mb-3"
      >
        <template #title>
          {{ $t('profile.apiKeys.newKey.heading', { name: newKey.name }) }}
        </template>
        <template #text>
          <p class="mb-2">
            {{ $t('profile.apiKeys.newKey.warning') }}
          </p>
          <HtCopyableText :data="newKey.token" />
        </template>
      </HtAlert>
    </div>

    <form
      v-if="canCreate"
      @submit.prevent="submit"
    >
      <h3 class="mb-2">
        {{ $t('profile.apiKeys.create.heading') }}
      </h3>
      <HtFormControlGroup :vertical="true">
        <HtFormControl
          id="api-key-name"
          :label="$t('profile.apiKeys.create.name')"
        >
          <HtInput
            v-model="form.name"
            type="text"
            class="mt-1"
            required
            maxlength="64"
            autocomplete="off"
            :placeholder="$t('profile.apiKeys.create.namePlaceholder')"
          />
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.name"
            />
          </template>
        </HtFormControl>

        <HtFormControl
          id="api-key-account"
          :label="$t('profile.apiKeys.create.account')"
        >
          <HtFormSelect
            v-model="form.discord_user_id"
            name="discord_user_id"
            :disabled="discordUsers.length < 2"
          >
            <option
              v-for="user of discordUsers"
              :key="user.id"
              :value="user.id"
            >
              {{ user.name }}
            </option>
          </HtFormSelect>
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.discord_user_id"
            />
          </template>
        </HtFormControl>

        <HtFormControl
          id="api-key-scopes"
          :label="$t('profile.apiKeys.create.scopes')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.scopes ?? form.errors['scopes.0']"
            />
          </template>
        </HtFormControl>
        <HtFormCheckboxControlled
          v-for="scope of scopes"
          :id="`api-key-scope-${scope}`"
          :key="scope"
          :checked="form.scopes.includes(scope)"
          name="scopes[]"
          :value="scope"
          @change="handleScopeChange"
        >
          <template #label>
            {{ $t(`profile.apiKeys.scopes.${scope}`) }}
          </template>
        </HtFormCheckboxControlled>

        <HtFormControl
          id="api-key-expiry"
          :label="$t('profile.apiKeys.create.expiry')"
        >
          <HtFormSelect
            v-model="form.expires_in_days"
            name="expires_in_days"
          >
            <option
              v-for="days of EXPIRY_DAYS"
              :key="days"
              :value="days"
            >
              {{ $t('profile.apiKeys.create.expiresInDays', { days: String(days) }) }}
            </option>
            <option :value="null">
              {{ $t('profile.apiKeys.create.neverExpires') }}
            </option>
          </HtFormSelect>
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.expires_in_days"
            />
          </template>
        </HtFormControl>
      </HtFormControlGroup>

      <HtFormSubmitButton
        id="create-api-key"
        :form="form"
        :save-text="$t('profile.apiKeys.create.submit')"
        :success-text="$t('profile.apiKeys.create.submit')"
      />
    </form>
    <FormMessage
      v-else-if="apiKeys.length >= maxKeys"
      type="error"
      :message="$t('profile.apiKeys.limitReached', { max: String(maxKeys) })"
    />
  </HtCard>
</template>
