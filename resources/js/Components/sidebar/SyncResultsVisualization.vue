<script setup lang="ts">
import { timeSyncInject } from '@/injection-keys';
import HtBadge from '@/Reusable/HtBadge.vue';
import { BadgeColor } from '@/utils/badges';
import { faServer, faUser } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed, inject } from 'vue';
import { Tippy, TippySingleton } from 'vue-tippy';

interface TimeSyncItem {
  t: number;
  unixMs: number;
}

const timeSync = inject(timeSyncInject);
const timeSyncItems = computed((): TimeSyncItem[] => [
  { t: 0, unixMs: timeSync?.t0?.getUnixMilliseconds() ?? 0 },
  { t: 1, unixMs: timeSync?.t1?.value ?? 0 },
  { t: 2, unixMs: timeSync?.t2?.value ?? 0 },
  { t: 3, unixMs: timeSync?.t3?.value ?? 0 },
].sort((a, b) => a.unixMs - b.unixMs));
const badeColors: BadgeColor[] = ['cyan', 'blue', 'purple', 'green'];
</script>

<template>
  <div class="time-sync-visualization">
    <TippySingleton>
      <template
        v-for="(item, index) in timeSyncItems"
        :key="item.t"
      >
        <Tippy
          class="time-sync-item"
        >
          <HtBadge :color="badeColors[item.t]">
            <template #prefix>
              <FontAwesomeIcon :icon="item.t > 0 && item.t < 3 ? faServer : faUser" />
            </template>
            t<sub>{{ item.t }}</sub>
          </HtBadge>
          <template #content>
            {{ $t(`global.sidebar.timeSync.t${item.t}`) }}
            <br>
            <HtBadge>
              {{
                $t('global.sidebar.timeSync.timestampValue', { value: String((item.unixMs) / 1e3) })
              }}
            </HtBadge>
          </template>
        </Tippy>

        <HtBadge
          v-if="index < 3"
          color="muted"
          class="time-sync-item"
        >
          {{
            $t('global.sidebar.timeSync.offsetAmount', { offset: String(timeSyncItems[index + 1].unixMs - item.unixMs) })
          }}
        </HtBadge>
      </template>
    </TippySingleton>
  </div>
</template>
