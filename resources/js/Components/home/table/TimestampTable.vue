<script setup lang="ts">
import TimestampTableRow from '@/Components/home/table/TimestampTableRow.vue';
import { dateTimeLibraryInject, timestampInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtTable from '@/Reusable/HtTable.vue';
import { faCalendar as faRegularCalendar } from '@fortawesome/free-regular-svg-icons';
import { faCalendar, faClock, faCode, faUserClock } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';

const ts = inject(timestampInject);
const dtl = inject(dateTimeLibraryInject);

const currentTimestamp = computed(() => ts?.currentTimezone.value && dtl?.value && dtl.value.getValueForIsoZonedDateTime(ts?.currentDate.value, ts?.currentTime.value, ts.currentTimezone.value));

const unixTs = computed(() => currentTimestamp.value?.getUnixSeconds());
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
      <TimestampTableRow
        :icon="{ cellHeight: 2}"
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.SHORT_DATE"
      >
        <template #icon>
          <FontAwesomeIcon
            :icon="faCalendar"
            size="2x"
          />
        </template>
      </TimestampTableRow>
      <TimestampTableRow
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.LONG_DATE"
      />
      <TimestampTableRow
        :icon="{ cellHeight: 2}"
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.SHORT_TIME"
      >
        <template #icon>
          <FontAwesomeIcon
            :icon="faClock"
            size="2x"
          />
        </template>
      </TimestampTableRow>
      <TimestampTableRow
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.LONG_TIME"
      />
      <TimestampTableRow
        :icon="{ cellHeight: 4}"
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.SHORT_FULL"
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
      </TimestampTableRow>
      <TimestampTableRow
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.LONG_FULL"
      />
      <TimestampTableRow
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.SHORT_COMPACT"
      />
      <TimestampTableRow
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.LONG_COMPACT"
      />
      <TimestampTableRow
        :icon="true"
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="MessageTimestampFormat.RELATIVE"
      >
        <template #icon>
          <FontAwesomeIcon
            :icon="faUserClock"
            size="2x"
          />
        </template>
      </TimestampTableRow>
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
