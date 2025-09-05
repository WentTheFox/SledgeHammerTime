<script setup lang="ts">
import { usageDataFetcherInject, UsageDataFetchFunction } from '@/injection-keys';
import BotInfoUsageGraph from '@/Pages/BotInfo/BotInfoUsageGraph.vue';
import HtTable from '@/Reusable/HtTable.vue';
import { randomlyGenerateCommandUsageData } from '@/utils/app';
import { provide } from 'vue';

enum MockCommandIds {
  NO_DATA = 'no-data',
  TOO_OLD_DATA = 'too-old-data',
  INFINITE_LOADING = 'infinite-loading',
}

const usageDataGenerator: UsageDataFetchFunction = (options) => {
  switch (options.id) {
    case MockCommandIds.NO_DATA:
      return Promise.resolve([]);
    case MockCommandIds.TOO_OLD_DATA:
      return Promise.resolve([{ date: '1970-01-01', value: 1 }]);
    case MockCommandIds.INFINITE_LOADING:
      return new Promise(() => undefined);
  }

  const totalCount = Math.round(10e3 + Math.random() * 5e3);
  const results = randomlyGenerateCommandUsageData(totalCount);
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(results);
    }, 250 + (Math.random() * 250));
  });
};
provide(usageDataFetcherInject, usageDataGenerator);
</script>

<template>
  <p class="mt-3 mb-3">
    Command usage graphs
  </p>
  <HtTable>
    <tbody>
      <tr>
        <th>No data</th>
        <td>
          <BotInfoUsageGraph
            :id="MockCommandIds.NO_DATA"
            type="command"
          />
        </td>
      </tr>
      <tr>
        <th>Too old data</th>
        <td>
          <BotInfoUsageGraph
            :id="MockCommandIds.TOO_OLD_DATA"
            type="command"
          />
        </td>
      </tr>
      <tr>
        <th>Loading state</th>
        <td>
          <BotInfoUsageGraph
            :id="MockCommandIds.INFINITE_LOADING"
            type="command"
          />
        </td>
      </tr>
      <tr>
        <th>Randomly generated data</th>
        <td>
          <BotInfoUsageGraph
            id=""
            type="command"
          />
        </td>
      </tr>
    </tbody>
  </HtTable>
</template>
