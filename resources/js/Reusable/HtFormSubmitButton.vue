<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import { formControlIdInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtProvide from '@/Reusable/HtProvide.vue';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { faCheck, faSave } from '@fortawesome/free-solid-svg-icons';
import { InertiaFormProps } from '@inertiajs/vue3';


withDefaults(defineProps<{
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

    <HtProvide
      :injection-key="formControlIdInject"
      :value="id"
    >
      <FormMessage
        type="success"
        :message="form.recentlySuccessful ? successText : undefined"
        class="mt-2"
      />
    </HtProvide>
  </div>
</template>
