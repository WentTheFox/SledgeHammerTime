<script setup lang="ts">
import TimestampTableRow, { IconType } from '@/Components/home/table/TimestampTableRow.vue';
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import {
  localSettingsInject,
  pagePropsInject,
  timestampInject,
  userInfoInject,
} from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtButton from '@/Reusable/HtButton.vue';
import HtButtonGroup from '@/Reusable/HtButtonGroup.vue';
import HtTable from '@/Reusable/HtTable.vue';
import { safeRoute } from '@/utils/safe-route';
import { faArrowRotateBack, faEdit } from '@fortawesome/free-solid-svg-icons';
import { computed, inject, ref } from 'vue';
import { Tippy } from 'vue-tippy';

const ts = inject(timestampInject);
const userInfo = inject(userInfoInject);
const localSettings = inject(localSettingsInject);
const pageProps = inject(pagePropsInject);

const route = useRoute();
const routeParams = useRouteParams(route, pageProps);
const profileEditUrl = computed(() => safeRoute('profile.edit', route, { routeParams: routeParams.value }));

const currentTimestamp = computed(() => ts!.currentTimestamp?.value ?? undefined);
const unixTs = computed(() => currentTimestamp.value?.getUnixSeconds());

const serverHiddenFormats = computed(() => new Set(userInfo?.value?.hiddenFormats ?? []));

const editMode = ref(false);

// 'unix' is a sentinel for the raw unix timestamp row
type FlatFormatKey = MessageTimestampFormat | 'unix';

const DEFAULT_ORDER: FlatFormatKey[] = [
  MessageTimestampFormat.SHORT_DATE,
  MessageTimestampFormat.LONG_DATE,
  MessageTimestampFormat.SHORT_TIME,
  MessageTimestampFormat.LONG_TIME,
  MessageTimestampFormat.SHORT_FULL,
  MessageTimestampFormat.LONG_FULL,
  MessageTimestampFormat.SHORT_COMPACT,
  MessageTimestampFormat.LONG_COMPACT,
  MessageTimestampFormat.RELATIVE,
  'unix',
];

function getIconType(f: FlatFormatKey): IconType {
  if (f === 'unix') return 'code';
  if (f === MessageTimestampFormat.SHORT_DATE || f === MessageTimestampFormat.LONG_DATE) return 'calendar';
  if (f === MessageTimestampFormat.SHORT_TIME || f === MessageTimestampFormat.LONG_TIME) return 'clock';
  if (f === MessageTimestampFormat.RELATIVE) return 'user-clock';
  return 'calendar-clock';
}

const orderedFormats = computed((): FlatFormatKey[] => {
  const available = DEFAULT_ORDER.filter(
    f => f === 'unix' || !serverHiddenFormats.value.has(f),
  );
  const customOrder = localSettings?.localFormatOrder ?? [];
  if (!customOrder.length) return available;
  const ordered = customOrder
    .filter((f): f is FlatFormatKey => available.includes(f as FlatFormatKey))
    .map(f => f as FlatFormatKey);
  const missing = available.filter(f => !ordered.includes(f));
  return [...ordered, ...missing];
});

// Formats visible to render (locally-hidden excluded outside edit mode)
// In edit mode, server-hidden formats are appended at the end so users can navigate to profile settings
const visibleFormats = computed((): FlatFormatKey[] => {
  const hidden = localSettings?.localHiddenFormats ?? [];
  if (editMode.value) {
    const serverHidden = DEFAULT_ORDER.filter(
      (f): f is MessageTimestampFormat => f !== 'unix' && serverHiddenFormats.value.has(f),
    );
    return [...orderedFormats.value, ...serverHidden];
  }
  return orderedFormats.value.filter(f => !hidden.includes(f));
});

// Group consecutive same-icon-type rows for rowspan
const tableRows = computed(() => {
  const rows = visibleFormats.value;
  const result: Array<{ key: FlatFormatKey; iconProp: true | { cellHeight: number } | undefined; iconType: IconType; isServerHidden: boolean }> = [];

  let i = 0;
  while (i < rows.length) {
    const currentType = getIconType(rows[i]);
    let groupSize = 1;
    while (i + groupSize < rows.length && getIconType(rows[i + groupSize]) === currentType) {
      groupSize++;
    }
    result.push({ key: rows[i], iconProp: groupSize > 1 ? { cellHeight: groupSize } : true, iconType: currentType, isServerHidden: rows[i] !== 'unix' && serverHiddenFormats.value.has(rows[i] as MessageTimestampFormat) });
    for (let j = 1; j < groupSize; j++) {
      result.push({ key: rows[i + j], iconProp: undefined, iconType: currentType, isServerHidden: rows[i + j] !== 'unix' && serverHiddenFormats.value.has(rows[i + j] as MessageTimestampFormat) });
    }
    i += groupSize;
  }
  return result;
});

// Drag state
const draggingFormat = ref<FlatFormatKey | null>(null);
const dragOverFormat = ref<FlatFormatKey | null>(null);
const dragOverPosition = ref<'before' | 'after'>('before');

function onDragStart(format: FlatFormatKey, e: DragEvent) {
  draggingFormat.value = format;
  e.dataTransfer!.effectAllowed = 'move';
}

function onDragOver(format: FlatFormatKey, e: DragEvent) {
  e.preventDefault();
  e.dataTransfer!.dropEffect = 'move';
  dragOverFormat.value = format;
  const target = e.currentTarget as HTMLElement;
  const rect = target.getBoundingClientRect();
  dragOverPosition.value = e.clientY < rect.top + rect.height / 2 ? 'before' : 'after';
}

function onDragleave() {
  dragOverFormat.value = null;
}

function onDrop(targetFormat: FlatFormatKey) {
  const src = draggingFormat.value;
  if (!src || src === targetFormat) {
    draggingFormat.value = null;
    dragOverFormat.value = null;
    return;
  }
  const current = [...orderedFormats.value];
  const fromIdx = current.indexOf(src);
  let toIdx = current.indexOf(targetFormat);

  if (dragOverPosition.value === 'after') toIdx++;
  current.splice(fromIdx, 1);
  if (fromIdx < toIdx) toIdx--;
  current.splice(toIdx, 0, src);

  localSettings?.setLocalFormatOrder(current);
  draggingFormat.value = null;
  dragOverFormat.value = null;
}

function onDragEnd() {
  draggingFormat.value = null;
  dragOverFormat.value = null;
}

function resetLocalSettings() {
  localSettings?.setLocalFormatOrder([]);
  for (const f of [...(localSettings?.localHiddenFormats ?? [])]) {
    localSettings?.toggleLocalHiddenFormat(f);
  }
  editMode.value = false;
}

const hasLocalCustomizations = computed(
  () => (localSettings?.localFormatOrder.length ?? 0) > 0
    || (localSettings?.localHiddenFormats.length ?? 0) > 0,
);
</script>

<template>
  <HtTable
    :responsive="true"
    class="timestamp-table"
  >
    <colgroup>
      <col style="width: 3rem">
      <col style="width: 16rem">
      <col>
      <col style="width: 5.5rem">
    </colgroup>
    <thead>
      <tr>
        <th colspan="2">
          {{ $t('timestampPicker.table.syntaxColumn') }}
        </th>
        <th class="result-column">
          {{ $t('timestampPicker.table.resultColumn') }}
        </th>
        <th class="edit-column">
          <HtButtonGroup>
            <Tippy>
              <HtButton
                :icon-start="faEdit"
                :icon-only="true"
                color="primary"
                :pressed="editMode"
                @click="editMode = !editMode"
              />
              <template #content>
                {{ $t('timestampPicker.table.editFormats') }}
              </template>
            </Tippy>
            <Tippy>
              <HtButton
                :icon-start="faArrowRotateBack"
                :icon-only="true"
                color="warning"
                :pressed="!hasLocalCustomizations"
                :disabled="!hasLocalCustomizations"
                @click="resetLocalSettings"
              />
              <template #content>
                {{ $t('timestampPicker.table.resetFormats') }}
              </template>
            </Tippy>
          </HtButtonGroup>
        </th>
      </tr>
    </thead>
    <tbody>
      <TimestampTableRow
        v-for="row in tableRows"
        :key="row.key"
        :icon="row.iconProp"
        :ts="currentTimestamp"
        :unix-ts="unixTs"
        :format="row.key !== 'unix' ? row.key : undefined"
        :edit-mode="editMode"
        :icon-type="row.iconType"
        :is-locally-hidden="localSettings?.localHiddenFormats.includes(row.key)"
        :is-server-hidden="row.isServerHidden"
        :profile-edit-url="row.isServerHidden ? profileEditUrl : undefined"
        :is-dragging="!row.isServerHidden && draggingFormat === row.key"
        :drag-over-position="!row.isServerHidden && dragOverFormat === row.key ? dragOverPosition : undefined"
        @toggle-visibility="localSettings?.toggleLocalHiddenFormat(row.key)"
        @dragstart="!row.isServerHidden && onDragStart(row.key, $event)"
        @dragover="!row.isServerHidden && onDragOver(row.key, $event)"
        @dragleave="onDragleave()"
        @drop="!row.isServerHidden && onDrop(row.key)"
        @dragend="onDragEnd()"
      />
    </tbody>
  </HtTable>
</template>
