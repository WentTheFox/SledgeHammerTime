<script setup lang="ts">
import SyncResultsVisualization from '@/Components/sidebar/SyncResultsVisualization.vue';
import { dateTimeLibraryInject, timeSyncInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible, { CollapsibleAPI } from '@/Reusable/HtCollapsible.vue';
import HtTable from '@/Reusable/HtTable.vue';
import { faCaretDown, faCaretUp, faClockRotateLeft } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject, nextTick, ref, useTemplateRef, watch } from 'vue';

const dtl = inject(dateTimeLibraryInject);
const timeSync = inject(timeSyncInject);
const detailsCollapsible = useTemplateRef<CollapsibleAPI>('details-collapsible');

const showSyncDetails = ref(false);

const inaccurateSystemClockThresholdMs = computed(() => dtl?.value.getMinimumOffsetMs());
const isSystemClockAccurate = computed(() => typeof timeSync?.ntpOffsetMs === 'number' && typeof inaccurateSystemClockThresholdMs.value === 'number' && (isNaN(timeSync.ntpOffsetMs) || timeSync.ntpOffsetMs < inaccurateSystemClockThresholdMs.value));
const roundTripDurationMs = computed(() => (timeSync?.t3?.value ?? 0) - (timeSync?.t0?.value ?? 0));

const syncTime = () => {
  timeSync?.syncTime();
};
watch(() => timeSync?.syncing, (newValue) => {
  if (newValue) return;
  nextTick(() => {
    detailsCollapsible.value?.recalculateHeight();
  });
});
</script>

<template>
  <section class="time-sync">
    <header>
      <FontAwesomeIcon
        :icon="faClockRotateLeft"
        :fixed-width="true"
      />
      <span class="ms-1">{{ $t('global.sidebar.timeSync.title') }}</span>
    </header>

    <HtAlert
      :closable="false"
      :compact="true"
      :type="isSystemClockAccurate ? 'info' : 'warning'"
      :loading="timeSync?.syncing"
    >
      <template #title>
        <template v-if="timeSync?.syncing">
          {{ $t('global.sidebar.timeSync.status.syncing') }}
        </template>
        <template v-else>
          {{
            isSystemClockAccurate ? $t('global.sidebar.timeSync.status.accurate') : $t('global.sidebar.timeSync.status.potentiallyWrong')
          }}
        </template>
      </template>
      <template
        v-if="!timeSync?.syncing"
        #text
      >
        {{
          $t('global.sidebar.timeSync.status.value', { offset: $t('global.sidebar.timeSync.offsetAmount', { offset: String(timeSync?.ntpOffsetMs) }) })
        }}
      </template>
      <template #actions>
        <HtButton
          :pressed="showSyncDetails"
          :icon-end="showSyncDetails ? faCaretUp : faCaretDown"
          @click="showSyncDetails = !showSyncDetails"
        >
          {{ $t('global.sidebar.timeSync.details') }}
        </HtButton>
      </template>
    </HtAlert>

    <HtCollapsible
      ref="details-collapsible"
      :visible="showSyncDetails"
      :animate="false"
    >
      <SyncResultsVisualization />
      <HtTable>
        <tbody>
          <tr>
            <th>{{ $t('global.sidebar.timeSync.networkOffsetCell') }}</th>
            <td>
              {{
                $t('global.sidebar.timeSync.offsetAmount', { offset: String(timeSync?.ntpOffsetMs) })
              }}
            </td>
          </tr>
          <tr>
            <th>{{ $t('global.sidebar.timeSync.roundTripDuration') }}</th>
            <td>
              {{
                $t('global.sidebar.timeSync.offsetAmount', { offset: String(roundTripDurationMs) })
              }}
            </td>
          </tr>
        </tbody>
      </HtTable>

      <HtButton
        type="submit"
        color="primary"
        :icon-start="faClockRotateLeft"
        :pressed="timeSync?.syncing"
        :loading="timeSync?.syncing"
        :disabled="!timeSync"
        @click="syncTime"
      >
        {{ $t('global.sidebar.timeSync.syncButtonLabel') }}
      </HtButton>
    </HtCollapsible>
  </section>
</template>
