<script lang="ts">
export type IconType = 'calendar' | 'clock' | 'calendar-clock' | 'user-clock' | 'code';
</script>

<script setup lang="ts">

import SyntaxDisplay, { SyntaxDisplayProps } from '@/Components/home/table/SyntaxDisplay.vue';
import TimestampPreview, {
  TimestampPreviewProps,
} from '@/Components/home/table/TimestampPreview.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import { faCalendar as faRegularCalendar } from '@fortawesome/free-regular-svg-icons';
import {
  faCalendar,
  faClock,
  faCode,
  faEye,
  faGripLines,
  faMinus,
  faPlus,
  faUserClock,
  faUserGear,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Tippy } from 'vue-tippy';

withDefaults(defineProps<SyntaxDisplayProps & TimestampPreviewProps & {
  icon?: true | { cellHeight?: number };
  iconType?: IconType;
  editMode?: boolean;
  isLocallyHidden?: boolean;
  isServerHidden?: boolean;
  profileEditUrl?: string;
  isDragging?: boolean;
  dragOverPosition?: 'before' | 'after';
}>(), {
  icon: undefined,
  iconType: undefined,
  editMode: false,
  isLocallyHidden: false,
  isServerHidden: false,
  profileEditUrl: undefined,
  isDragging: false,
  dragOverPosition: undefined,
});

const emit = defineEmits<{
  toggleVisibility: [];
  dragstart: [e: DragEvent];
  dragover: [e: DragEvent];
  dragleave: [e: DragEvent];
  drop: [e: DragEvent];
  dragend: [];
}>();
</script>

<template>
  <tr
    :draggable="editMode && !isServerHidden"
    :class="{
      'dragging': isDragging,
      'drag-over-before': dragOverPosition === 'before',
      'drag-over-after': dragOverPosition === 'after',
      'locally-hidden': (isLocallyHidden || isServerHidden) && editMode,
    }"
    @dragstart="$emit('dragstart', $event)"
    @dragover="$emit('dragover', $event)"
    @dragleave="$emit('dragleave', $event)"
    @drop="$emit('drop', $event)"
    @dragend="$emit('dragend')"
  >
    <td
      v-if="icon"
      :rowspan="typeof icon === 'object' ? icon?.cellHeight : undefined"
      class="icon-column"
    >
      <FontAwesomeIcon
        v-if="iconType === 'calendar'"
        :icon="faCalendar"
        size="2x"
      />
      <FontAwesomeIcon
        v-else-if="iconType === 'clock'"
        :icon="faClock"
        size="2x"
      />
      <FontAwesomeIcon
        v-else-if="iconType === 'user-clock'"
        :icon="faUserClock"
        size="2x"
      />
      <FontAwesomeIcon
        v-else-if="iconType === 'code'"
        :icon="faCode"
        size="2x"
      />
      <span
        v-else
        class="fa-stack fa-1x"
      >
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
    </td>
    <td class="syntax-column">
      <SyntaxDisplay
        v-if="typeof unixTs !== 'undefined' && !isNaN(unixTs)"
        :unix-ts="unixTs"
        :format="format"
      />
      <div class="result-mobile mt-2">
        <FontAwesomeIcon
          :icon="faEye"
          class="me-2"
        />
        <TimestampPreview
          :ts="ts"
          :unix-ts="unixTs"
          :format="format"
        />
      </div>
    </td>
    <td
      class="result-column"
      :colspan="editMode ? 1 : 2"
    >
      <TimestampPreview
        :ts="ts"
        :unix-ts="unixTs"
        :format="format"
      />
    </td>
    <td
      v-if="editMode"
      class="controls-column"
    >
      <template v-if="isServerHidden">
        <Tippy>
          <HtLinkButton
            :href="profileEditUrl ?? '#'"
            :icon-start="faUserGear"
            :icon-only="true"
          />
          <template #content>
            {{ $t('timestampPicker.table.unhideInProfile') }}
          </template>
        </Tippy>
      </template>
      <template v-else>
        <span
          class="drag-handle"
          aria-hidden="true"
        >
          <FontAwesomeIcon :icon="faGripLines" />
        </span>
        <Tippy>
          <HtButton
            :icon-start="isLocallyHidden ? faPlus : faMinus"
            :icon-only="true"
            :pressed="isLocallyHidden"
            @click.stop="emit('toggleVisibility')"
          />
          <template #content>
            {{ isLocallyHidden ? $t('timestampPicker.table.showFormat') : $t('timestampPicker.table.hideFormat') }}
          </template>
        </Tippy>
      </template>
    </td>
  </tr>
</template>
