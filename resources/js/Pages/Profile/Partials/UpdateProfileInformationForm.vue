<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import { useRoute } from '@/composables/useRoute';
import { devModeInject, userInfoInject } from '@/injection-keys';
import { validMessageTimestampFormats } from '@/model/message-timestamp-format';
import HtCard from '@/Reusable/HtCard.vue';
import HtFormCheckboxControlled from '@/Reusable/HtFormCheckboxControlled.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormSubmitButton from '@/Reusable/HtFormSubmitButton.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { useForm } from '@inertiajs/vue3';
import { inject } from 'vue';

const user = inject(userInfoInject);
const devMode = inject(devModeInject);

const form = useForm({
  name: user?.value?.name ?? '',
  hidden_formats: user?.value?.hiddenFormats ?? [] as string[],
});

const route = useRoute();

const handleHiddenChange = (e: Event) => {
  const target = e.target;
  if (!(target instanceof HTMLInputElement)) {
    return;
  }

  if (target.checked) {
    form.hidden_formats = [...form.hidden_formats, target.value];
  } else {
    form.hidden_formats = form.hidden_formats.filter(v => v !== target.value);
  }
};
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
        <HtFormControl
          id="hidden-formats"
          :label="$t('profile.information.hiddenFormats')"
        >
          <template #message>
            <FormMessage
              type="error"
              class="mt-2"
              :message="form.errors.hidden_formats"
            />
          </template>
        </HtFormControl>
        <HtFormCheckboxControlled
          v-for="format in validMessageTimestampFormats"
          :id="'hide-'+format"
          :key="format"
          :checked="form.hidden_formats.includes(format)"
          name="hidden_formats[]"
          :value="format"
          :label="format"
          @change.passive="handleHiddenChange"
        />
      </HtFormControlGroup>

      <pre v-if="devMode"><code>{{ JSON.stringify(form.data(), null, 2) }}</code></pre>

      <HtFormSubmitButton
        :form="form"
        :success-text="$t('profile.information.saveSuccess')"
      />
    </form>
  </HtCard>
</template>
