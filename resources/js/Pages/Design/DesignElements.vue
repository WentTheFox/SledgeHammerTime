<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { localSettings, sidebarState } from '@/injection-keys';
import DesignAlerts from '@/Pages/Design/Elements/DesignAlerts.vue';
import DesignBadges from '@/Pages/Design/Elements/DesignBadges.vue';
import DesignBotInfo from '@/Pages/Design/Elements/DesignBotInfo.vue';
import DesignButtons from '@/Pages/Design/Elements/DesignButtons.vue';
import DesignCollapsible from '@/Pages/Design/Elements/DesignCollapsible.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtTable from '@/Reusable/HtTable.vue';
import { loremIpsum } from 'lorem-ipsum';
import { inject } from 'vue';

const placeholderText = loremIpsum();

const sidebarStateValue = inject(sidebarState);
const localSettingsValue = inject(localSettings);
</script>

<template>
  <DesignAlerts :placeholder-text="placeholderText" />

  <HtCard>
    <template #header>
      <h2>2nd Level Card header</h2>
    </template>

    <p class="mb-3">
      Logo
    </p>

    <ApplicationLogo :size="100" />

    <DesignButtons />

    <p class="mt-3 mb-3">
      Badges
    </p>
    <div>
      <DesignBadges />
      <div>&nbsp;</div>
      <DesignBadges prefix="Prefixed" />
      <div>&nbsp;</div>
      <DesignBadges suffix="Suffixed" />
      <div>&nbsp;</div>
      <DesignBadges
        prefix="Prefixed"
        suffix="Suffixed"
      />
    </div>

    <p class="mt-3 mb-3">
      Table
    </p>
    <HtTable>
      <thead>
        <tr>
          <th>Table Header Cell 1</th>
          <th>Table Header Cell 2</th>
          <th>Table Header Cell 3</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Table Body Data Cell 1 / 1</td>
          <td>Table Body Data Cell 1 / 2</td>
          <td>Table Body Data Cell 1 / 3</td>
        </tr>
        <tr>
          <th>Table Body header Cell 2 / 1</th>
          <td>Table Body Data Cell 2 / 2</td>
          <td>Table Body Data Cell 2 / 3</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td>Table Footer Cell 1</td>
          <td>Table Footer Cell 2</td>
          <td>Table Footer Cell 3</td>
        </tr>
      </tfoot>
    </HtTable>

    <DesignCollapsible />
  </HtCard>
  <DesignBotInfo />
</template>

