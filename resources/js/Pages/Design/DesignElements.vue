<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { localSettings, sidebarState } from '@/injection-keys';
import DesignAlerts from '@/Pages/Design/Elements/DesignAlerts.vue';
import DesignBadges from '@/Pages/Design/Elements/DesignBadges.vue';
import DesignBotInfo from '@/Pages/Design/Elements/DesignBotInfo.vue';
import DesignButtons from '@/Pages/Design/Elements/DesignButtons.vue';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
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

    <p class="mb-3">
      Components
    </p>

    <DesignButtons />
    <div>&nbsp;</div>
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
  </HtCard>
  <DesignBotInfo />
  <HtCard>
    <template #header>
      Sidebar control
    </template>

    <dl class="mb-3">
      <dt>isOpen</dt>
      <dd>{{ sidebarStateValue?.isOpen }}</dd>
      <dt>isOnRight</dt>
      <dd>{{ localSettingsValue?.sidebarOnRight }}</dd>
    </dl>

    <div>
      <HtButton
        color="success"
        @click="sidebarStateValue?.setIsOpen(true)"
      >
        Open
      </HtButton>
      &nbsp;
      <HtButton
        color="danger"
        @click="sidebarStateValue?.setIsOpen(false)"
      >
        Close
      </HtButton>
      &nbsp;
      <HtButton @click="localSettingsValue?.toggleSidebarOnRight()">
        Toggle Left/Right
      </HtButton>
    </div>
  </HtCard>
</template>

