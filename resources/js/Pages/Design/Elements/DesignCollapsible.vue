<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtCollapsible from '@/Reusable/HtCollapsible.vue';
import { ref } from 'vue';

const visible = ref(true);
const maxHeight = ref<number | undefined>(undefined);
const demoMaxHeight = 115;
</script>

<template>
  <p class="mb-3">
    Collapsible
  </p>
  <div class="mt-2 mb-2">
    <HtButton @click="visible = !visible">
      Toggle visibility
    </HtButton>
    &nbsp;
    <HtButton
      :disabled="Boolean(maxHeight)"
      @click="maxHeight = demoMaxHeight"
    >
      Set max height to {{ demoMaxHeight }}px
    </HtButton>
    &nbsp;
    <HtButton
      :disabled="!maxHeight"
      @click="maxHeight = undefined"
    >
      Clear max height
    </HtButton>
  </div>

  <HtCollapsible
    :visible="visible"
    :max-height="maxHeight"
  >
    <p>This is the contents of the collapsible container.</p>
    <p>The height will be calculated dynamically depending on how large the content is when opening it.</p>
    <p>
      There is a way to limit the maximum height in case teh component contains a long list of items, in which case the
      contents will become scrollable.
    </p>
    <p>This<br>is<br>some<br>text<br>to<br>make<br>it<br>taller.</p>
  </HtCollapsible>
</template>

