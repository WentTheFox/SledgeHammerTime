<script setup lang="ts">
import HtCard from '@/Reusable/HtCard.vue';
import DesignFormsContent from '@/Pages/Design/Elements/DesignFormsContent.vue';
import { ComboboxOption } from '@/utils/combobox';
import { onMounted, ref } from 'vue';

const textValue = ref('Example text');
const numberValue = ref(42);
const dateValue = ref<string | null>(null);
const timeValue = ref<string | null>(null);
const selectValue = ref('option1');
const checkboxValue = ref(true);
const radioValue = ref('radio1');
const comboboxValue = ref('c1');

const selectOptions = [
  { value: 'option1', label: 'Option 1' },
  { value: 'option2', label: 'Option 2' },
  { value: 'option3', label: 'Option 3' },
];

const comboboxOptions: ComboboxOption[] = [
  { value: 'c1', label: 'Combobox Option 1' },
  { value: 'c2', label: 'Combobox Option 2' },
  { value: 'c3', label: 'Combobox Option 3' },
];

onMounted(() => {
  const now = new Date();
  dateValue.value = now.toISOString().split('T')[0];
  timeValue.value = now.toTimeString().split(' ')[0].substring(0, 5);
});
</script>

<template>
  <HtCard>
    <template #header>
      <h2>Forms</h2>
    </template>
    <div class="forms-side-by-side mt-4">
      <div class="form">
        <h3 class="mb-3">
          Regular
        </h3>
        <DesignFormsContent
          v-model:text-value="textValue"
          v-model:number-value="numberValue"
          v-model:date-value="dateValue"
          v-model:time-value="timeValue"
          v-model:select-value="selectValue"
          v-model:checkbox-value="checkboxValue"
          v-model:radio-value="radioValue"
          v-model:combobox-value="comboboxValue"
          id-prefix="regular"
          :select-options="selectOptions"
          :combobox-options="comboboxOptions"
        />
      </div>

      <div class="form">
        <h3 class="mb-3">
          Readonly
        </h3>
        <DesignFormsContent
          v-model:text-value="textValue"
          v-model:number-value="numberValue"
          v-model:date-value="dateValue"
          v-model:time-value="timeValue"
          v-model:select-value="selectValue"
          v-model:checkbox-value="checkboxValue"
          v-model:radio-value="radioValue"
          v-model:combobox-value="comboboxValue"
          id-prefix="readonly"
          :select-options="selectOptions"
          :combobox-options="comboboxOptions"
        />
      </div>

      <div class="form">
        <h3 class="mb-3">
          Disabled
        </h3>
        <DesignFormsContent
          v-model:text-value="textValue"
          v-model:number-value="numberValue"
          v-model:date-value="dateValue"
          v-model:time-value="timeValue"
          v-model:select-value="selectValue"
          v-model:checkbox-value="checkboxValue"
          v-model:radio-value="radioValue"
          v-model:combobox-value="comboboxValue"
          id-prefix="disabled"
          :select-options="selectOptions"
          :combobox-options="comboboxOptions"
        />
      </div>
    </div>
  </HtCard>
</template>

<style lang="scss" scoped>
.forms-side-by-side {
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-start;

  .form {
    display: block;
    flex: 1 0 auto;
  }
}
</style>
