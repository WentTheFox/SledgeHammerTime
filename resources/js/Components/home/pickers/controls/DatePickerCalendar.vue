<script setup lang="ts">
import {
  CalendarContext,
  DateTimeLibraryMonth,
  DateTimeLibraryValue,
  DateTimeLibraryWeekday,
} from '@/classes/DateTimeLibraryValue';
import CalendarButton from '@/Components/home/pickers/controls/CalendarButton.vue';
import CalendarContextText from '@/Components/home/pickers/controls/CalendarContextText.vue';
import CalendarGridHeader from '@/Components/home/pickers/controls/CalendarGridHeader.vue';
import { useCurrentDate } from '@/composables/useCurrentDate';
import { useDateLibraryLocale } from '@/composables/useDateLibraryLocale';
import { useLocale } from '@/composables/useLocale';
import {
  dateTimeLibraryInject,
  devModeInject,
  InputMethod,
  inputMethodInject,
  pagePropsInject,
} from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import {
  CalendarDecadeYear,
  CalendarMonthDay,
  CalendarYearMonth,
  generateCalendarDecade,
  generateCalendarMonth,
  generateCalendarYear,
  getWeekdayItems,
  WeekdayItem,
  WEEKEND_DAYS,
} from '@/utils/calendar';
import { faChevronLeft, faChevronRight } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import classNames from 'classnames';
import { computed, inject, nextTick, onUnmounted, ref, useTemplateRef, watch } from 'vue';

const props = defineProps<{
  selectedYear: number,
  selectedMonth: number,
  selectedDate: number,
  currentContext: CalendarContext,
}>();

const emit = defineEmits<{
  (e: 'setDate', year: number, month: number, date: number): void
  (e: 'setContext', newContext: CalendarContext): void
}>();

const devMode = inject(devModeInject);
const calendarRef = useTemplateRef<HTMLDivElement>('calendarRef');

const year = ref(props.selectedYear);
const month = ref(props.selectedMonth);
const date = ref(props.selectedDate);

const pageProps = inject(pagePropsInject);
const locale = useLocale(pageProps);
const dtl = inject(dateTimeLibraryInject);
const inputMethod = inject(inputMethodInject);
const dateLibLocale = useDateLibraryLocale(dtl);

const firstDayOfWeek = computed(() => {
  switch (locale.value) {
    case 'ms':
      return DateTimeLibraryWeekday.Sunday;
    default:
      return dateLibLocale.value?.getWeekInfo().firstDay ?? DateTimeLibraryWeekday.Monday;
  }
});

const weekdaysItems = computed(() => getWeekdayItems(dateLibLocale.value?.getShortWeekdays() ?? [], firstDayOfWeek.value));

const calendarMonth = computed(() => generateCalendarMonth({
  dtl: dtl?.value,
  locale: dateLibLocale.value,
  year: year.value,
  month: month.value - 1,
  firstDayOfWeek: firstDayOfWeek.value,
}));
const calendarYear = computed(() => generateCalendarYear({
  dtl: dtl?.value,
  locale: dateLibLocale.value,
  year: year.value,
}));
const calendarDecade = computed(() => generateCalendarDecade({
  dtl: dtl?.value,
  locale: dateLibLocale.value,
  year: year.value,
}));
const lastFocusedCalendarButtonInputId = ref<string | null>(null);

const dateTime = computed((): DateTimeLibraryValue | null => {
  return dtl?.value.getValueForDate(year.value, month.value - 1, date.value) ?? null;
});

const currentDate = useCurrentDate(dtl);

const isShowingCurrentMonth = computed(() => {
  return month.value === currentDate.value.month + 1 && year.value === currentDate.value.year;
});

const getDayClasses = (calendarMonthDay: CalendarMonthDay) => {
  const weekendDaysData = WEEKEND_DAYS[locale.value];
  const weekdayClass = typeof calendarMonthDay.weekday === 'number' ? weekendDaysData?.[calendarMonthDay.weekday] : undefined;
  return classNames(weekdayClass);
};
const getDayCurrent = (calendarMonthDay: CalendarMonthDay) => {
  return calendarMonthDay.date === currentDate.value.date && calendarMonthDay.month === currentDate.value.month && calendarMonthDay.year === currentDate.value.year;
};
const getDaySelected = (calendarMonthDay: CalendarMonthDay) => {
  return calendarMonthDay.date === props.selectedDate && calendarMonthDay.month === props.selectedMonth - 1 && calendarMonthDay.year === props.selectedYear;
};
const getDayFaded = (calendarMonthDay: CalendarMonthDay) => calendarMonthDay.month !== month.value - 1;

const getWeekdayClasses = (weekdayItem: WeekdayItem) => {
  const weekendDaysData = WEEKEND_DAYS[locale.value];
  const weekdayClass = weekendDaysData?.[weekdayItem.index];
  return classNames(weekdayClass);
};

const stepDate = (direction: -1 | 1, add: 'month' | 'year' | 'decade') => {
  switch (add) {
    case 'month':
      if (direction > 0) {
        if (month.value - 1 === DateTimeLibraryMonth.December) {
          month.value = DateTimeLibraryMonth.January + 1;
          year.value++;
        } else {
          month.value++;
        }
      } else {
        if (month.value - 1 === DateTimeLibraryMonth.January) {
          month.value = DateTimeLibraryMonth.December + 1;
          year.value--;
        } else {
          month.value--;
        }
      }
      break;
    case 'year':
      year.value += direction;
      break;
    case 'decade':
      year.value += direction * 10;
      break;
  }
};

const setDate = (calendarMonthDay: CalendarMonthDay) => {
  year.value = calendarMonthDay.year;
  month.value = calendarMonthDay.month + 1;
  date.value = calendarMonthDay.date;
  emit('setDate', year.value, month.value, date.value);
};

const setMonth = (calendarYearMonth: CalendarYearMonth) => {
  year.value = calendarYearMonth.year;
  month.value = calendarYearMonth.month + 1;
  if (inputMethod?.value !== InputMethod.KEYBOARD) {
    emit('setContext', CalendarContext.DATE);
  }
};

const setYear = (calendarDecadeYear: CalendarDecadeYear) => {
  year.value = calendarDecadeYear.year;
  if (inputMethod?.value !== InputMethod.KEYBOARD) {
    emit('setContext', CalendarContext.MONTH);
  }
};

const setSelection = (newYear: number, newMonth: number, newDate: number) => {
  year.value = newYear;
  month.value = newMonth;
  date.value = newDate;
};

const jumpToToday = () => {
  setSelection(currentDate.value.year, currentDate.value.month + 1, currentDate.value.date);
};

const switchContext = () => {
  switch (props.currentContext) {
    case CalendarContext.DATE:
      emit('setContext', CalendarContext.MONTH);
      break;
    case CalendarContext.MONTH:
      emit('setContext', CalendarContext.DECADE);
      break;
  }
};

enum StepDirection {
  BACKWARD = -1,
  FORWARD = 1,
}

const stepInContext = (direction: StepDirection) => {
  switch (props.currentContext) {
    case CalendarContext.DATE:
      stepDate(direction, 'month');
      break;
    case CalendarContext.MONTH:
      stepDate(direction, 'year');
      break;
    case CalendarContext.DECADE:
      stepDate(direction, 'decade');
      break;
  }
};

const handleDateButtonFocus = (inputId: string) => {
  lastFocusedCalendarButtonInputId.value = inputId;
};

const backwardButtonAriaLabelI18nKey = computed(() => {
  switch (props.currentContext) {
    case CalendarContext.DECADE:
      return 'timestampPicker.picker.tooltip.previousDecade';
    case CalendarContext.MONTH:
      return 'timestampPicker.picker.tooltip.previousYear';
    case CalendarContext.DATE:
      return 'timestampPicker.picker.tooltip.previousMonth';
    default:
      throw new Error(`Backward button aria label key missing for context ${props.currentContext}`);
  }
});
const forwardButtonAriaLabelI18nKey = computed(() => {
  switch (props.currentContext) {
    case CalendarContext.DECADE:
      return 'timestampPicker.picker.tooltip.nextDecade';
    case CalendarContext.MONTH:
      return 'timestampPicker.picker.tooltip.nextYear';
    case CalendarContext.DATE:
      return 'timestampPicker.picker.tooltip.nextMonth';
    default:
      throw new Error(`Forward button aria label key missing for context ${props.currentContext}`);
  }
});

export interface DatePickerCalendarApi {
  open: typeof open;
  setSelection: typeof setSelection;
}

defineExpose<DatePickerCalendarApi>({
  open,
  setSelection,
});


const focusAnimationFrame = ref<ReturnType<typeof window.requestAnimationFrame> | null>(null);
const clearFocusAnimationFrame = () => {
    if (focusAnimationFrame.value !== null) {
      cancelAnimationFrame(focusAnimationFrame.value);
      focusAnimationFrame.value = null;
    }
};

const restoreCalendarButtonFocus = (attempt: number = 1) => {
  if (lastFocusedCalendarButtonInputId.value === null || props.currentContext !== CalendarContext.DATE) {
    return;
  }

  if (attempt >= 60) {
    console.warn(`Failed to set focus on #${lastFocusedCalendarButtonInputId.value} after ${attempt} attempts`);
    return;
  }

  if (document.activeElement?.id === lastFocusedCalendarButtonInputId.value) {
    return;
  }

  const targetInput = document.getElementById(lastFocusedCalendarButtonInputId.value);
  if (!targetInput) {
    clearFocusAnimationFrame();
    focusAnimationFrame.value = window.requestAnimationFrame(() => restoreCalendarButtonFocus(attempt + 1));
    return;
  }

  targetInput.focus();

  if (focusAnimationFrame.value !== null) {
    clearInterval(focusAnimationFrame.value);
  }
  focusAnimationFrame.value = null;
};

watch(() => [year.value, month.value, date.value, props.currentContext], () => {
  // Attempt to restore the focus state on the date button after the calendar layout changes
  nextTick(() => restoreCalendarButtonFocus());
});


const forceCalendarButtonFocus = () => {
  if (lastFocusedCalendarButtonInputId.value !== null && props.currentContext === CalendarContext.DATE) {
    return;
  }

  const checkedInput = calendarRef.value?.querySelector<HTMLInputElement>('input:checked');
  if (checkedInput) {
    checkedInput.focus();
    return;
  }
  const firstInput = calendarRef.value?.querySelector<HTMLInputElement>('label:not(.hidden) > input');
  if (firstInput) {
    firstInput.focus();
    return;
  }
};
watch(() => props.currentContext, () => {
  // Attempt to restore the focus state on the checked button after the calendar layout changes
  nextTick(() => forceCalendarButtonFocus());
});

onUnmounted(() => {
  clearFocusAnimationFrame();
});
</script>

<template>
  <div class="calendar-controls">
    <HtButtonGroup>
      <HtButton
        :aria-label="$t(backwardButtonAriaLabelI18nKey)"
        @click="stepInContext(StepDirection.BACKWARD)"
      >
        <FontAwesomeIcon
          :icon="faChevronLeft"
          class="icon-ltr"
        />
        <FontAwesomeIcon
          :icon="faChevronRight"
          class="icon-rtl"
        />
      </HtButton>
    </HtButtonGroup>
    <HtButton
      v-if="dateLibLocale && dateTime"
      class="calendar-context"
      :block="true"
      :justify-center="true"
      :pressed="currentContext === CalendarContext.DECADE"
      :disabled="currentContext === CalendarContext.DECADE"
      @click.prevent="switchContext"
    >
      <CalendarContextText
        :date-time="dateTime"
        :date-lib-locale="dateLibLocale"
        :current-context="currentContext"
      />
    </HtButton>
    <HtButtonGroup>
      <HtButton
        :aria-label="$t(forwardButtonAriaLabelI18nKey)"
        @click="stepInContext(StepDirection.FORWARD)"
      >
        <FontAwesomeIcon
          :icon="faChevronRight"
          class="icon-ltr"
        />
        <FontAwesomeIcon
          :icon="faChevronLeft"
          class="icon-rtl"
        />
      </HtButton>
    </HtButtonGroup>
  </div>
  <HtFormControlGroup
    v-if="devMode"
    :vertical="true"
  >
    <HtButton
      :disabled="isShowingCurrentMonth"
      :block="true"
      @click="jumpToToday"
    >
      {{ $t('timestampPicker.picker.button.jumpToToday') }}
    </HtButton>
  </HtFormControlGroup>
  <div
    ref="calendarRef"
    class="calendar"
  >
    <fieldset v-if="currentContext === CalendarContext.DATE">
      <div class="calendar-grid calendar-weekdays">
        <CalendarGridHeader
          v-for="weekdayItem in weekdaysItems"
          :key="weekdayItem.index"
          :class="getWeekdayClasses(weekdayItem)"
        >
          {{ weekdayItem.name }}
        </CalendarGridHeader>
      </div>
      <div
        v-for="(calendarWeek, index) in calendarMonth.weeks"
        :key="index"
        class="calendar-grid calendar-week"
      >
        <CalendarButton
          v-for="calendarDay in calendarWeek"
          :key="`${calendarDay.month}-${calendarDay.date}`"
          name="date"
          :value="`${calendarDay.year}-${calendarDay.month+1}-${calendarDay.date}`"
          :class="getDayClasses(calendarDay)"
          :selected="getDaySelected(calendarDay)"
          :current="getDayCurrent(calendarDay)"
          :faded="getDayFaded(calendarDay)"
          :navigation-only="index === 0 ? 'top' : (index ===calendarMonth.weeks.length - 1 ? 'bottom' : undefined)"
          @click="setDate(calendarDay)"
          @focus="handleDateButtonFocus"
        >
          {{ calendarDay.display }}
        </CalendarButton>
      </div>
    </fieldset>
    <fieldset v-else-if="currentContext === CalendarContext.MONTH">
      <div
        v-for="(quarter, index) in calendarYear.months"
        :key="index"
        class="calendar-grid calendar-quarter"
      >
        <CalendarButton
          v-for="calendarYearMonth in quarter"
          :key="`${calendarYearMonth.year}-${calendarYearMonth.month}`"
          name="month"
          :value="`${calendarYearMonth.year}-${calendarYearMonth.month}`"
          :selected="calendarYearMonth.month === month - 1 && calendarYearMonth.year === year"
          :current="calendarYearMonth.month === currentDate.month && calendarYearMonth.year === currentDate.year"
          @click="setMonth(calendarYearMonth)"
          @switch-context="emit('setContext', CalendarContext.DATE)"
        >
          {{ calendarYearMonth.display }}
        </CalendarButton>
      </div>
    </fieldset>
    <fieldset v-else-if="currentContext === CalendarContext.DECADE">
      <div
        v-for="(row, index) in calendarDecade.rows"
        :key="index"
        class="calendar-grid calendar-decade"
      >
        <CalendarButton
          v-for="calendarDecadeYear in row"
          :key="calendarDecadeYear.year"
          name="year"
          :value="String(calendarDecadeYear.year)"
          :selected="calendarDecadeYear.year === year"
          :current="calendarDecadeYear.year === currentDate.year"
          @click="setYear(calendarDecadeYear)"
          @switch-context="emit('setContext', CalendarContext.MONTH)"
        >
          {{ calendarDecadeYear.display }}
        </CalendarButton>
      </div>
    </fieldset>
  </div>
</template>
