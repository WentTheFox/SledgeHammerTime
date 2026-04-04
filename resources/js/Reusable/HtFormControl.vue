<script setup lang="ts">
import HtFormControlId from '@/Reusable/HtFormControlId.vue';
import HtFormControlWrap from '@/Reusable/HtFormControlWrap.vue';
import { IconDefinition } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

withDefaults(defineProps<{
  id: string,
  label: string,
  labelIcon?: IconDefinition,
  comboBox?: boolean,
  fullWidth?: boolean,
}>(), {
  comboBox: false,
  fullWidth: false,
  labelIcon: undefined,
});
</script>

<template>
  <HtFormControlWrap
    :combo-box="comboBox"
    :full-width="fullWidth"
  >
    <HtFormControlId :id="id">
      <div class="form-control">
        <label
          class="form-control-label"
          :for="id"
        ><FontAwesomeIcon
          v-if="labelIcon"
          :icon="labelIcon"
          class="me-2"
        />{{ label }}</label>
        <slot />
      </div>
      <slot name="message" />
    </HtFormControlId>
  </HtFormControlWrap>
</template>
