import { InputMethod } from '@/injection-keys';
import { onBeforeUnmount, onMounted, ref } from 'vue';

export const useInputMethod = () => {
  const inputMethod = ref<InputMethod>(InputMethod.UNKNOWN);

  const handleKeyboard = () => {
    inputMethod.value = InputMethod.KEYBOARD;
  };
  const handleMouse = () => {
    inputMethod.value = InputMethod.MOUSE;
  };
  const handleTouch = () => {
    inputMethod.value = InputMethod.TOUCH;
  };

  onMounted(() => {
    window.addEventListener('keydown', handleKeyboard, { passive: true });
    window.addEventListener('mousedown', handleMouse, { passive: true });
    window.addEventListener('touchstart', handleTouch, { passive: true });
  });

  onBeforeUnmount(() => {
    window.removeEventListener('keydown', handleKeyboard);
    window.removeEventListener('mousedown', handleMouse);
    window.removeEventListener('touchstart', handleTouch);
  });

  return inputMethod;
};
