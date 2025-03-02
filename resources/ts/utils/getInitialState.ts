import { ref, onMounted, getCurrentInstance } from 'vue';

export function useInitialState(attributeName: string, defaultValue = 0) {
  const initialValue = ref(defaultValue);

  onMounted(() => {
    const instance = getCurrentInstance();
    if (instance) {
      const element = instance.proxy?.$el as HTMLElement;
      if (element && element.hasAttribute(attributeName)) {
        const rawValue = element.getAttribute(attributeName);
        try {
          const parsedValue = JSON.parse(rawValue || 'null');
          initialValue.value = parsedValue ?? defaultValue;
        } catch (e) {
          initialValue.value = rawValue ? Number(rawValue) : defaultValue;
        }
      }
    }
  });

  return initialValue;
}
