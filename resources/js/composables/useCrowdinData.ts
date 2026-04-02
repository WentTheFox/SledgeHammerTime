import { pagePropsInject } from '@/injection-keys';
import { computed, inject } from 'vue';

export const useCrowdinData = () => {
  const pageProps = inject(pagePropsInject);
  return computed(() => pageProps?.value?.crowdinData);
};
