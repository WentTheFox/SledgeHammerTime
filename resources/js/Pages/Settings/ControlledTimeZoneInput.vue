<script setup lang="ts">
import TimeZonePicker, { TimeZonePickerApi } from '@/Components/home/pickers/TimeZonePicker.vue';
import { dateTimeLibraryInject, positionAnchor } from '@/injection-keys';
import HtFormControlReadOnlyInput from '@/Reusable/HtFormControlReadOnlyInput.vue';
import { InputApi } from '@/Reusable/HtInput.vue';
import { convertTimeZoneSelectionToString } from '@/utils/time';
import { computed, inject, provide, useTemplateRef } from 'vue';

const props = defineProps<{
  name?: string;
  class?: string;
}>();

const picker = useTemplateRef<TimeZonePickerApi>('timezone-picker');
const inputEl = useTemplateRef<InputApi>('input-el');

const model = defineModel<string>({ required: true });

const dtl = inject(dateTimeLibraryInject);
const currentTimezone = computed(() => {
  return dtl?.value.getDefaultInitialTimezoneSelection(model.value);
});

const openPopup = (e: KeyboardEvent | MouseEvent) => {
  let viaKeyboard = false;
  if ('key' in e) {
    if (e.key === 'Tab' || e.key === 'Shift') {
      return;
    }
    viaKeyboard = true;
  }

  e.preventDefault();
  if (!currentTimezone.value) {
    return;
  }

  picker.value?.open(currentTimezone.value, viaKeyboard ? inputEl.value : null);
};

const positionAnchorName = '--timezone-input';
provide(positionAnchor, positionAnchorName);
</script>

<template>
  <div>
    <HtFormControlReadOnlyInput
      ref="input-el"
      :class="props.class"
      :value="model.replace(/^([+-])/, 'GMT$1')"
      :hide-selection="true"
      :position-anchor-name="positionAnchorName"
      @click.prevent="openPopup"
      @keydown="openPopup"
    />
    <input
      type="hidden"
      :name="name"
      :value="model"
    >
    <TimeZonePicker
      ref="timezone-picker"
      :save-on-close="false"
      @change="v => model = convertTimeZoneSelectionToString(v)"
    />
  </div>
</template>
