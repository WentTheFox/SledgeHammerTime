<script setup lang="ts">

import { DateTimeLibraryValue } from '@/classes/DateTimeLibraryValue';
import { dateTimeLibraryInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTable from '@/Reusable/HtTable.vue';
import { calculateNtpOffset } from '@/utils/time';
import { faClockRotateLeft } from '@fortawesome/free-solid-svg-icons';
import axios from 'axios';
import { computed, getCurrentInstance, inject, ref, watch } from 'vue';

const dtl = inject(dateTimeLibraryInject);
const instance = getCurrentInstance();

/**
 * The client's timestamp of the request packet transmission
 */
const t0 = ref<DateTimeLibraryValue | null>(null);
/**
 * The server's timestamp of the request packet reception
 */
const t1 = ref<DateTimeLibraryValue | null>(null);
/**
 * The server's timestamp of the response packet transmission
 */
const t2 = ref<DateTimeLibraryValue | null>(null);
/**
 * The client's timestamp of the response packet reception
 */
const t3 = ref<DateTimeLibraryValue | null>(null);

const ntpOffsetMs = computed(() => calculateNtpOffset(
  t0.value?.getUnixMilliseconds(),
  t1.value?.getUnixMilliseconds(),
  t2.value?.getUnixMilliseconds(),
  t3.value?.getUnixMilliseconds(),
));

const syncing = ref(false);

const syncTime = async () => {
  if (!dtl) return;

  syncing.value = true;
  t0.value = dtl.value.now();
  const result = await axios.get(route('app.ntp'));
  t3.value = dtl.value.now();
  if (result.status !== 200) {
    console.error(`Sync failed (HTTP ${result.status})`);
  } else {
    const { data } = result;
    if ('requestTs' in data && typeof data.requestTs === 'number') {
      t1.value = dtl.value.fromTimestampMsUtc(data.requestTs);
    }
    if ('responseTs' in data && typeof data.requestTs === 'number') {
      t2.value = dtl.value.fromTimestampMsUtc(data.responseTs);
    }
  }

  syncing.value = false;
};

watch([ntpOffsetMs, syncing], ([newNtpOffsetMs, isSyncing]) => {
  if (typeof newNtpOffsetMs !== 'number' || typeof dtl === 'undefined' || isSyncing) {
    return;
  }

  dtl.value.updateOffset(Math.round(newNtpOffsetMs));
  console.log(dtl.value.offset, newNtpOffsetMs);

  instance?.proxy?.$forceUpdate();
});
</script>

<template>
  <HtCard class="time-sync">
    <template #header>
      <h2>{{ $t('global.timeSync.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('global.timeSync.description') }}
    </p>

    <HtButton
      color="primary"
      :icon-start="faClockRotateLeft"
      :pressed="syncing"
      :loading="syncing"
      :disabled="!dtl"
      @click="syncTime"
    >
      Synchronize
    </HtButton>

    <h3 class="mt-2">
      Stats
    </h3>
    <HtTable>
      <tbody>
        <tr>
          <th>{{ $t('global.timeSync.dtlOffsetCell') }}</th>
          <td> {{ $t('global.timeSync.offsetAmount', { offset: String(dtl?.offset) }) }}</td>
        </tr>
        <tr>
          <th>t<sub>0</sub></th>
          <td>{{ t0?.getUnixMilliseconds() }}</td>
        </tr>
        <tr>
          <th>t<sub>1</sub></th>
          <td>{{ t1?.getUnixMilliseconds() }}</td>
        </tr>
        <tr>
          <th>t<sub>2</sub></th>
          <td>{{ t2?.getUnixMilliseconds() }}</td>
        </tr>
        <tr>
          <th>t<sub>3</sub></th>
          <td>{{ t3?.getUnixMilliseconds() }}</td>
        </tr>
        <tr>
          <th>{{ $t('global.timeSync.networkOffsetCell') }}</th>
          <td> {{ $t('global.timeSync.offsetAmount', { offset: String(ntpOffsetMs) }) }}</td>
        </tr>
      </tbody>
    </HtTable>
  </HtCard>
</template>

<style scoped>

</style>
