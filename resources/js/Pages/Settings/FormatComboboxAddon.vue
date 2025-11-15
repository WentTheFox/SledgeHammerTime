<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { dateTimeLibraryInject } from '@/injection-keys';
import { isValidMessageTimestampFormat } from '@/model/message-timestamp-format';
import { ComboboxAddonComponentProps } from '@/utils/combobox';
import { computed, inject } from 'vue';

const props = defineProps<ComboboxAddonComponentProps>();

const dtl = inject(dateTimeLibraryInject);

const mtf = computed(() => isValidMessageTimestampFormat(props.option.value) ? props.option.value : null);
</script>

<template>
  <template v-if="mtf && dtl">
    <TimestampPreview
      :ts="dtl?.now()"
      :format="mtf"
    />
  </template>
</template>
