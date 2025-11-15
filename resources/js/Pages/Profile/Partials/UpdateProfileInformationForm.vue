<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import { useRoute } from '@/composables/useRoute';
import HtCard from '@/Reusable/HtCard.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSubmitButton from '@/Reusable/HtFormSubmitButton.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
  name: user.name,
});

const route = useRoute();
</script>

<template>
  <HtCard>
    <template #header>
      <h2>{{ $t('profile.information.heading') }}</h2>

      <p class="mt-1">
        {{ $t('profile.information.description') }}
      </p>
    </template>

    <form @submit.prevent="form.patch(route('profile.update'))">
      <HtFormControlGroup :vertical="true">
        <HtFormControl
          id="name"
          :label="$t('profile.information.displayName')"
        >
          <HtInput
            v-model="form.name"
            type="text"
            class="mt-1"
            required
            autofocus
            autocomplete="name"
          />
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.name"
            />
          </template>
        </HtFormControl>
      </HtFormControlGroup>

      <HtFormSubmitButton
        :form="form"
        :success-text="$t('profile.information.saveSuccess')"
      />
    </form>
  </HtCard>
</template>
