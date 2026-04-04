<script setup lang="ts">
import HtFormControlSettings from '@/Reusable/HtFormControlSettings.vue';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

withDefaults(defineProps<{
  id: string;
  label: string;
  disabled?: boolean;
  fullWidth?: boolean;
  labelIcon?: IconDefinition;
}>(), {
  disabled: undefined,
  fullWidth: undefined,
  labelIcon: undefined,
});
</script>

<template>
  <HtFormControlSettings
    :id="id"
    :disabled="disabled"
    :full-width="fullWidth"
  >
    <HtFormControlWrap>
      <div class="form-control">
        <label
          class="form-control-label"
          :for="id"
        >
          <FontAwesomeIcon
            v-if="labelIcon"
            :icon="labelIcon"
            class="me-2"
          />
          {{ label }}</label>
        <slot />
      </div>
      <slot name="message" />
    </HtFormControlWrap>
  </HtFormControlSettings>
</template>
