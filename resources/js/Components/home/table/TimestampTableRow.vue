<script setup lang="ts">

import SyntaxDisplay, { SyntaxDisplayProps } from '@/Components/home/table/SyntaxDisplay.vue';
import TimestampPreview, { TimestampPreviewProps } from '@/Components/home/table/TimestampPreview.vue';
import { faEye } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

withDefaults(defineProps<SyntaxDisplayProps & TimestampPreviewProps & {
  icon?: true | { cellHeight?: number };
}>(), {
  icon: undefined,
  iconCellHeight: undefined,
});
</script>

<template>
  <tr>
    <td
      v-if="icon"
      :rowspan="typeof icon === 'object' ? icon?.cellHeight : undefined"
      class="icon-column"
    >
      <slot name="icon" />
    </td>
    <td class="syntax-column">
      <SyntaxDisplay
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
    <td class="result-column">
      <TimestampPreview
        :ts="ts"
        :unix-ts="unixTs"
        :format="format"
      />
    </td>
  </tr>
</template>
