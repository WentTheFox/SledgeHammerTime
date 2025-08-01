<script setup lang="ts">
import { dateTimeLibraryInject, timeSyncInject } from '@/injection-keys';
import HtBadge from '@/Reusable/HtBadge.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtTable from '@/Reusable/HtTable.vue';
import { faClockRotateLeft } from '@fortawesome/free-solid-svg-icons';
import { inject, ref } from 'vue';

const dtl = inject(dateTimeLibraryInject);
const timeSync = inject(timeSyncInject);

const autoApply = ref(false);
</script>

<template>
  <HtCard class="time-sync">
    <template #header>
      <h2>{{ $t('global.timeSync.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('global.timeSync.description') }}
    </p>

    <form @submit.prevent="timeSync?.syncTime(autoApply)">
      <HtFormControlGroup>
        <HtFormCheckboxModelled
          id="auto-apply"
          v-model="autoApply"
          name="autoApply"
          :label="$t('global.timeSync.autoApplyCheckbox')"
        />
      </HtFormControlGroup>
      <HtButton
        type="submit"
        color="primary"
        :icon-start="faClockRotateLeft"
        :pressed="timeSync?.syncing"
        :loading="timeSync?.syncing"
        :disabled="!timeSync"
      >
        {{ $t('global.timeSync.syncButtonLabel') }}
      </HtButton>
    </form>

    <h3 class="mt-2">
      {{ $t('global.timeSync.syncResultsHeading') }}
    </h3>
    <HtTable>
      <tbody>
        <tr>
          <th>{{ $t('global.timeSync.dtlOffsetCell') }}</th>
          <td>{{ $t('global.timeSync.offsetAmount', { offset: String(dtl?.offset) }) }}</td>
        </tr>
        <tr>
          <th>
            {{ $t('global.timeSync.t0') }}
            <HtBadge class="ms-2">
              t<sub>0</sub>
            </HtBadge>
          </th>
          <td>{{ $t('global.timeSync.timestampValue', { value: timeSync?.t0?.getUnixMilliseconds() / 1e3 }) }}</td>
        </tr>
        <tr>
          <th>
            {{ $t('global.timeSync.t1') }}
            <HtBadge>t<sub>1</sub></HtBadge>
          </th>
          <td>{{ $t('global.timeSync.timestampValue', { value: timeSync?.t1?.getUnixMilliseconds() / 1e3 }) }}</td>
        </tr>
        <tr>
          <th>
            {{ $t('global.timeSync.t2') }}
            <HtBadge>t<sub>2</sub></HtBadge>
          </th>
          <td>{{ $t('global.timeSync.timestampValue', { value: timeSync?.t2?.getUnixMilliseconds() / 1e3 }) }}</td>
        </tr>
        <tr>
          <th>
            {{ $t('global.timeSync.t3') }}
            <HtBadge>t<sub>3</sub></HtBadge>
          </th>
          <td>{{ $t('global.timeSync.timestampValue', { value: timeSync?.t3?.getUnixMilliseconds() / 1e3 }) }}</td>
        </tr>
        <tr>
          <th>{{ $t('global.timeSync.networkOffsetCell') }}</th>
          <td>{{ $t('global.timeSync.offsetAmount', { offset: String(timeSync?.ntpOffsetMs) }) }}</td>
        </tr>
      </tbody>
    </HtTable>
  </HtCard>
</template>
