<script setup lang="ts">
import { useFormControlId } from '@/composables/useFormControlId';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import { faCheck } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { useSlots } from 'vue';

const props = defineProps<{
  id?: string,
  label?: string,
  disabled?: boolean,
}>();

const slots = useSlots();

const formControlId = useFormControlId(props);
</script>

<template>
  <HtFormControlWrap :disabled="disabled">
    <div class="form-control-checkbox">
      <span class="form-checkbox-input-wrap">
        <slot name="input" />
        <FontAwesomeIcon
          :icon="faCheck"
          class="form-checkbox-check-icon"
          :fixed-width="true"
        />
      </span>
      <label
        class="form-checkbox-label"
        :for="formControlId"
      >
        <slot name="label" />
        <template v-if="!slots.label">{{ label }}</template>
      </label>
    </div>
    <slot name="message" />
  </HtFormControlWrap>
</template>
