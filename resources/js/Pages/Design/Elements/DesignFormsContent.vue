<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtFormCombobox from '@/Reusable/HtFormCombobox.vue';
import HtFormControl from '@/Reusable/HtFormControl.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormRadio from '@/Reusable/HtFormRadio.vue';
import HtFormSelect from '@/Reusable/HtFormSelect.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { ComboboxOption } from '@/utils/combobox';
import { computed } from 'vue';

const props = defineProps<{
  idPrefix: 'regular' | 'readonly' | 'disabled';
  selectOptions: { value: string; label: string }[];
  comboboxOptions: ComboboxOption[];
}>();

const textValue = defineModel<string>('textValue', { required: true });
const numberValue = defineModel<number>('numberValue', { required: true });
const dateValue = defineModel<string|null>('dateValue', { required: true });
const timeValue = defineModel<string|null>('timeValue', { required: true });
const selectValue = defineModel<string>('selectValue', { required: true });
const checkboxValue = defineModel<boolean>('checkboxValue', { required: true });
const radioValue = defineModel<string>('radioValue', { required: true });
const comboboxValue = defineModel<string | null>('comboboxValue', { required: true });

const readonly = computed(() => props.idPrefix === 'readonly');
const disabled = computed(() => props.idPrefix === 'disabled');
</script>

<template>
  <HtFormControlGroup :vertical="true">
    <HtFormControl
      :id="`${idPrefix}-text`"
      label="Text Input"
    >
      <HtInput
        :id="`${idPrefix}-text`"
        v-model="textValue"
        :readonly="readonly"
        :disabled="disabled"
      />
      <template #message>
        <FormMessage
          type="error"
          message="This is an error message"
        />
      </template>
    </HtFormControl>

    <HtFormControl
      :id="`${idPrefix}-number`"
      label="Number Input"
    >
      <HtInput
        :id="`${idPrefix}-number`"
        v-model="numberValue"
        type="number"
        :readonly="readonly"
        :disabled="disabled"
      />
      <template #message>
        <FormMessage
          type="success"
          message="This is a success message"
        />
      </template>
    </HtFormControl>

    <HtFormControl
      :id="`${idPrefix}-date`"
      label="Date Input"
    >
      <HtInput
        :id="`${idPrefix}-date`"
        v-model="dateValue"
        type="date"
        :readonly="readonly"
        :disabled="disabled"
      />
      <template #message>
        <FormMessage
          type="description"
          message="This is a description message"
        />
      </template>
    </HtFormControl>

    <HtFormControl
      :id="`${idPrefix}-time`"
      label="Time Input"
    >
      <HtInput
        :id="`${idPrefix}-time`"
        v-model="timeValue"
        type="time"
        :readonly="readonly"
        :disabled="disabled"
      />
    </HtFormControl>

    <HtFormControl
      :id="`${idPrefix}-select`"
      label="Select"
    >
      <HtFormSelect
        v-model="selectValue"
        :name="`${idPrefix}-select`"
        :readonly="readonly"
        :disabled="disabled"
      >
        <option
          v-for="option in selectOptions"
          :key="option.value"
          :value="option.value"
        >
          {{ option.label }}
        </option>
      </HtFormSelect>
      <template #message>
        <FormMessage
          type="error"
          message="Selected option is invalid"
        />
      </template>
    </HtFormControl>

    <HtFormControl
      :id="`${idPrefix}-combobox`"
      label="Combobox"
      :combo-box="true"
    >
      <HtFormCombobox
        v-model="comboboxValue"
        :options="comboboxOptions"
        :readonly="readonly"
        :disabled="disabled"
      />
      <template #message>
        <FormMessage
          type="success"
          message="Combobox value is valid"
        />
      </template>
    </HtFormControl>

    <HtFormCheckboxModelled
      v-if="!readonly"
      :id="`${idPrefix}-checkbox`"
      v-model="checkboxValue"
      label="Checkbox"
      :disabled="disabled"
    >
      <template #message>
        <FormMessage
          type="description"
          message="This is a description for the checkbox"
        />
      </template>
    </HtFormCheckboxModelled>

    <HtFormControlGroup>
      <HtFormRadio
        :id="`${idPrefix}-radio-1`"
        label="Radio 1"
        :name="`${idPrefix}-radio`"
        value="radio1"
        :checked="radioValue === 'radio1'"
        :readonly="readonly"
        :disabled="disabled"
        @change="radioValue = 'radio1'"
      >
        <template #message>
          <FormMessage
            type="error"
            message="Radio error"
          />
        </template>
      </HtFormRadio>
      <HtFormRadio
        :id="`${idPrefix}-radio-2`"
        label="Radio 2"
        :name="`${idPrefix}-radio`"
        value="radio2"
        :checked="radioValue === 'radio2'"
        :readonly="readonly"
        :disabled="disabled"
        @change="radioValue = 'radio2'"
      />
    </HtFormControlGroup>
  </HtFormControlGroup>
</template>
