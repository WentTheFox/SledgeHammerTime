<script setup lang="ts">
import HtFormInputGroupSymbol from '@/Reusable/HtFormInputGroupSymbol.vue';
import HtInput from '@/Reusable/HtInput.vue';
import { inputRangeLimitBlurHandlerFactory } from '@/utils/app';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  halveBases?: boolean;
}>(), {
  halveBases: false,
});

const year = defineModel<number>('year', { required: true });
const month = defineModel<number>('month', { required: true });
const date = defineModel<number>('date', { required: true });

const handleYearBlur = inputRangeLimitBlurHandlerFactory(year);
const handleMonthBlur = inputRangeLimitBlurHandlerFactory(month);
const handleDateBlur = inputRangeLimitBlurHandlerFactory(date);

const flexBasisMultiplier = computed(() => props.halveBases ? 0.5 : 1);
</script>

<template>
  <HtInput
    v-model="year"
    type="number"
    :class="'date-picker-input grid-flex-item flex-basis-' + (40 * flexBasisMultiplier)"
    @blur="handleYearBlur"
  />
  <HtFormInputGroupSymbol>-</HtFormInputGroupSymbol>
  <HtInput
    v-model="month"
    type="number"
    :class="'date-picker-input grid-flex-item flex-basis-' + (30 * flexBasisMultiplier)"
    min="1"
    max="12"
    @blur="handleMonthBlur"
  />
  <HtFormInputGroupSymbol>-</HtFormInputGroupSymbol>
  <HtInput
    v-model="date"
    type="number"
    :class="'date-picker-input grid-flex-item flex-basis-' + (30 * flexBasisMultiplier)"
    min="1"
    max="31"
    @blur="handleDateBlur"
  />
</template>

<style lang="scss" scoped>
.date-picker-input {
  text-align: center;
}
</style>
