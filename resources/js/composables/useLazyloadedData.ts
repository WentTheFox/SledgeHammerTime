import { computed, ComputedRef, InjectionKey, provide, Ref, ref, watch } from 'vue';

/**
 * Some routes omit data from page props (for HTML caching).
 * When props carry null, fetch it asynchronously; on other pages use props directly.
 */
export const useLazyData = <T>(
  propsGetter: () => T,
  dataLoader: () => Promise<{ data: T }>,
  lazyDataInject: InjectionKey<ComputedRef<T>>,
  lazyDataLoadingInject: InjectionKey<Ref<boolean>>,
): { lazyData: ComputedRef<T | null>, lazyDataLoading: Ref<boolean> } => {
  const lazyDataFromProps = computed(propsGetter)
  const asyncLazyData = ref<T | null>(null);
  const lazyDataLoading = ref(true);
  watch(lazyDataFromProps, async (propsUser) => {
    if (propsUser !== null) {
      asyncLazyData.value = null;
      return;
    }
    if (!import.meta.env.SSR) {
      lazyDataLoading.value = true;
      try {
        const { data } = await dataLoader();
        asyncLazyData.value = data;
      } catch {
        asyncLazyData.value = null;
      } finally {
        lazyDataLoading.value = false;
      }
    }
  }, { immediate: true });
  const lazyData = computed(() => lazyDataFromProps.value ?? asyncLazyData.value);

  provide(lazyDataInject, lazyData);
  provide(lazyDataLoadingInject, lazyDataLoading);

  return { lazyData, lazyDataLoading };
};
