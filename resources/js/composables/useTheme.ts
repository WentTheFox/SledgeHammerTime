import { LocalSettingsValue } from '@/injection-keys';
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

export function useTheme(settings: LocalSettingsValue) {
  const darkMediaMatches = ref<boolean>(false);
  const isLightTheme = computed(() => settings.isLightTheme ?? !darkMediaMatches.value);
  const usingSystemStyle = computed(() => settings.isLightTheme === null);
  const themeWatcher = ([lightValue, isSystem]: [boolean, boolean]) => {
    if (typeof document === 'undefined') return;

    document.documentElement.style.colorScheme = isSystem ? '' : (lightValue ? 'light' : 'dark');
  };
  watch([isLightTheme, usingSystemStyle], themeWatcher, { immediate: true });

  const colorSchemeMedia = typeof window !== 'undefined'
    ? window.matchMedia('(prefers-color-scheme: dark)')
    : undefined;
  const handleMediaChange = (e: Pick<MediaQueryListEvent, 'matches'>) => {
    darkMediaMatches.value = e.matches;
  };

  onMounted(() => {
    if (!colorSchemeMedia) return;

    handleMediaChange(colorSchemeMedia);
    colorSchemeMedia.addEventListener('change', handleMediaChange);
  });

  onUnmounted(() => {
    colorSchemeMedia?.removeEventListener('change', handleMediaChange);
  });

  return {
    isLightTheme,
    usingSystemStyle,
    changeTheme: (isLight: boolean | null) => {
      settings.setLightTheme(isLight);
    },
  };
}
