<script setup lang="ts">
import TimestampTableRow from '@/Components/home/table/TimestampTableRow.vue';
import TimestampTableRowGroup from '@/Components/home/table/TimestampTableRowGroup.vue';
import { dateTimeLibraryInject, timestampInject, userInfoInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtTable from '@/Reusable/HtTable.vue';
import { faCalendar as faRegularCalendar } from '@fortawesome/free-regular-svg-icons';
import { faCalendar, faClock, faCode, faUserClock } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const ts = inject(timestampInject);
const dtl = inject(dateTimeLibraryInject);
const userInfo = inject(userInfoInject);

const currentTimestamp = computed(() => ts?.currentTimezone.value && dtl?.value && dtl.value.getValueForIsoZonedDateTime(ts?.currentDate.value, ts?.currentTime.value, ts.currentTimezone.value));

const unixTs = computed(() => currentTimestamp.value?.getUnixSeconds());

const hiddenFormats = computed(() => new Set(userInfo?.value?.hiddenFormats ?? []));
</script>

<template>
  <HtTable
    :responsive="true"
    class="timestamp-table"
  >
    <colgroup>
      <col style="width: 3rem">
      <col style="width: 16rem">
    </colgroup>
    <thead>
      <tr>
        <th colspan="2">
          {{ $t('timestampPicker.table.syntaxColumn') }}
        </th>
        <th class="result-column">
          {{ $t('timestampPicker.table.resultColumn') }}
        </th>
      </tr>
    </thead>
    <tbody>
      <TimestampTableRowGroup
        :current-timestamp="currentTimestamp"
        :unix-ts="unixTs"
        :formats="[MessageTimestampFormat.SHORT_DATE,MessageTimestampFormat.LONG_DATE]"
        :hidden-formats="hiddenFormats"
      >
        <template #icon>
          <FontAwesomeIcon
            :icon="faCalendar"
            size="2x"
          />
        </template>
      </TimestampTableRowGroup>
      <TimestampTableRowGroup
        :current-timestamp="currentTimestamp"
        :unix-ts="unixTs"
        :formats="[MessageTimestampFormat.SHORT_TIME,MessageTimestampFormat.LONG_TIME]"
        :hidden-formats="hiddenFormats"
      >
        <template #icon>
          <FontAwesomeIcon
            :icon="faClock"
            size="2x"
          />
        </template>
      </TimestampTableRowGroup>
      <TimestampTableRowGroup
        :current-timestamp="currentTimestamp"
        :unix-ts="unixTs"
        :formats="[MessageTimestampFormat.SHORT_FULL,MessageTimestampFormat.LONG_FULL,MessageTimestampFormat.SHORT_COMPACT,MessageTimestampFormat.LONG_COMPACT]"
        :hidden-formats="hiddenFormats"
      >
        <template #icon>
          <span class="fa-stack fa-1x">
            <FontAwesomeIcon
              :icon="faRegularCalendar"
              class="fa-stack-2x"
            />
            <FontAwesomeIcon
              :icon="faClock"
              class="fa-stack-1x"
              :transform="{ y: 4.5 }"
            />
          </span>
        </template>
      </TimestampTableRowGroup>
      <TimestampTableRowGroup
        :current-timestamp="currentTimestamp"
        :unix-ts="unixTs"
        :formats="[MessageTimestampFormat.RELATIVE]"
        :hidden-formats="hiddenFormats"
      >
        <template #icon>
          <FontAwesomeIcon
            :icon="faUserClock"
            size="2x"
          />
        </template>
      </TimestampTableRowGroup>
      <TimestampTableRow
        :icon="true"
        :ts="currentTimestamp"
        :unix-ts="unixTs"
      >
        <template #icon>
          <FontAwesomeIcon
            :icon="faCode"
            size="2x"
          />
        </template>
      </TimestampTableRow>
    </tbody>
  </HtTable>
</template>
