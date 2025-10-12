<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import HtButton from '@/Reusable/HtButton.vue';
import { faCheck, faSave } from '@fortawesome/free-solid-svg-icons';
import { InertiaFormProps } from '@inertiajs/vue3';


defineProps<{
  saveText?: string;
  successText: string;
  // eslint-disable-next-line @typescript-eslint/no-explicit-any -- more specific types cause errors at each usage
  form: InertiaFormProps<any>;
}>();
</script>

<template>
  <div class="from-control-submit">
    <HtButton
      :color="form.recentlySuccessful ? 'success' : 'primary'"
      :loading="form.processing"
      type="submit"
      :icon-start="form.recentlySuccessful ? faCheck : faSave"
    >
      {{ saveText ?? $t('actions.save') }}
    </HtButton>

    <FormMessage
      type="success"
      :message="form.recentlySuccessful ? successText : undefined"
      class="mt-2"
    />
  </div>
</template>
