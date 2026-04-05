import { crowdinDataInject } from '@/injection-keys';
import { inject } from 'vue';

export const useCrowdinData = () => {
  return inject(crowdinDataInject);
};
