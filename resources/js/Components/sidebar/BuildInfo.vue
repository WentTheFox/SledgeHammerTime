<script setup lang="ts">
import TimestampPreview from '@/Components/home/table/TimestampPreview.vue';
import { dateTimeLibraryInject } from '@/injection-keys';
import { MessageTimestampFormat } from '@/model/message-timestamp-format';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import { GITHUB_REPO_URL } from '@/utils/app';
import { computed, inject } from 'vue';
import { Tippy } from 'vue-tippy';

const commitHash = __GIT_COMMIT_HASH__;
const commitDate = __GIT_COMMIT_DATE__;

const dtl = inject(dateTimeLibraryInject);

const commitUrl = computed(() => commitHash
  ? `${GITHUB_REPO_URL}/commit/${commitHash}`
  : null,
);

const commitTs = computed(() => commitDate && dtl?.value
  ? dtl.value.fromIsoString(commitDate)
  : undefined,
);
</script>

<template>
  <Tippy
    v-if="commitHash && commitUrl"
    class="build-info"
  >
    <HtExternalLink :href="commitUrl">
      {{ commitHash }}
    </HtExternalLink>
    <template
      v-if="commitTs"
      #content
    >
      <TimestampPreview
        :ts="commitTs"
        :format="MessageTimestampFormat.RELATIVE"
      />
    </template>
  </Tippy>
</template>
