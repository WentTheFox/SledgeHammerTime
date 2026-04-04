<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import { formControlDisabledInject, formControlIdInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { faCheck, faSave } from '@fortawesome/free-solid-svg-icons';
import { InertiaFormProps } from '@inertiajs/vue3';
import { computed, provide } from 'vue';

const props = withDefaults(defineProps<{
  id: string;
  saveText?: string;
  successText: string;
  disabled?: boolean;
  saveIcon?: IconDefinition;
  // eslint-disable-next-line @typescript-eslint/no-explicit-any -- more specific types cause errors at each usage
  form: InertiaFormProps<any>;
}>(), {
  saveText: undefined,
  disabled: false,
  saveIcon: undefined,
});

provide(formControlIdInject, computed(() => props.id));
provide(formControlDisabledInject, computed(() => props.disabled));
</script>

<template>
  <div class="from-control-submit">
    <HtButtonGroup :separated="true">
      <HtButton
        :id="id"
        :color="form.recentlySuccessful ? 'success' : 'primary'"
        :loading="form.processing"
        type="submit"
        :icon-start="form.recentlySuccessful ? faCheck : (saveIcon ?? faSave)"
        :disabled="disabled"
      >
        {{ saveText ?? $t('actions.save') }}
      </HtButton>

      <slot />
    </HtButtonGroup>

    <FormMessage
      type="success"
      :message="form.recentlySuccessful ? successText : undefined"
      class="mt-2"
    />
  </div>
</template>
