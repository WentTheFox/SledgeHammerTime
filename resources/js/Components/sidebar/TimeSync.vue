<script setup lang="ts">
import FormMessage from '@/Components/FormMessage.vue';
import SyncResultsVisualization from '@/Components/sidebar/SyncResultsVisualization.vue';
import { dateTimeLibraryInject, localSettingsInject, timeSyncInject } from '@/injection-keys';
import HtAlert from '@/Reusable/HtAlert.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtCollapsible, { CollapsibleAPI } from '@/Reusable/HtCollapsible.vue';
import HtFormCheckboxControlled from '@/Reusable/HtFormCheckboxControlled.vue';
import HtFormCheckboxModelled from '@/Reusable/HtFormCheckboxModelled.vue';
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtTable from '@/Reusable/HtTable.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { fa0, faCaretDown, faCaretUp, faClockRotateLeft } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject, nextTick, ref, useTemplateRef, watch } from 'vue';

const settings = inject(localSettingsInject);
const dtl = inject(dateTimeLibraryInject);
const timeSync = inject(timeSyncInject);
const detailsCollapsible = useTemplateRef<CollapsibleAPI>('details-collapsible');

const showSyncDetails = ref(false);
const autoApply = ref(true);

const inaccurateSystemClockThresholdMs = computed(() => dtl?.value.getMinimumOffsetMs());
const isSystemClockAccurate = computed(() => typeof timeSync?.ntpOffsetMs === 'number' && typeof inaccurateSystemClockThresholdMs.value === 'number' && timeSync.ntpOffsetMs < inaccurateSystemClockThresholdMs.value);
const roundTripDurationMs = computed(() => (timeSync?.t3?.value ?? 0) - (timeSync?.t0?.value ?? 0));

const syncTime = () => {
  timeSync?.syncTime(autoApply.value);
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
            <th>{{ $t('global.sidebar.timeSync.dtlOffsetCell') }}</th>
            <td>
              {{
                $t('global.sidebar.timeSync.offsetAmount', { offset: String(dtl?.offset) })
              }}
            </td>
          </tr>
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

      <HtFormControlGroup>
        <HtFormCheckboxControlled
          id="auto-time-sync"
          :label="$t('global.sidebar.timeSync.autoTimeSync.label')"
          :checked="Boolean(settings?.autoTimeSync)"
          @change="settings?.toggleAutoTimeSync"
        >
          <template #message>
            <FormMessage class="mt-1">
              <template #message>
                <HtTranslate
                  i18n-key="global.sidebar.timeSync.autoTimeSync.description"
                  :replacements="{ offset: $t('global.sidebar.timeSync.offsetAmount', { offset: String(inaccurateSystemClockThresholdMs) }) }"
                >
                  <template #1="slotProps">
                    <strong>{{ slotProps.text }}</strong>
                  </template>
                </HtTranslate>
              </template>
              =
            </FormMessage>
          </template>
        </HtFormCheckboxControlled>
      </HtFormControlGroup>
      <form @submit.prevent="syncTime">
        <HtFormControlGroup>
          <HtFormCheckboxModelled
            id="auto-apply"
            v-model="autoApply"
            name="autoApply"
            :label="$t('global.sidebar.timeSync.autoApplyCheckbox', {
              syncButtonLabel: $t('global.sidebar.timeSync.syncButtonLabel'),
              offset: $t('global.sidebar.timeSync.offsetAmount', { offset: String(inaccurateSystemClockThresholdMs) }),
            })"
          />
        </HtFormControlGroup>
        <HtButtonGroup :separated="true">
          <HtButton
            type="submit"
            color="primary"
            :icon-start="faClockRotateLeft"
            :pressed="timeSync?.syncing"
            :loading="timeSync?.syncing"
            :disabled="!timeSync"
          >
            {{ $t('global.sidebar.timeSync.syncButtonLabel') }}
          </HtButton>
          <HtButton
            :icon-start="fa0"
            :disabled="dtl?.offset === 0"
            @click="dtl?.updateOffset(0)"
          >
            {{ $t('global.sidebar.timeSync.resetOffsetButtonLabel') }}
          </HtButton>
        </HtButtonGroup>
      </form>
    </HtCollapsible>
  </section>
</template>
