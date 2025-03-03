<script setup lang="ts">
import { ref, watch } from 'vue';

const props = defineProps<{
  id: string;
  label: string;
  modelValue: string;
  required?: boolean;
}>();

const emit = defineEmits(['update:modelValue']);
const displayValue = ref(props.modelValue);

watch(
  () => props.modelValue,
  (newValue) => {
    displayValue.value = newValue;
  }
);

const handleBlur = () => {
  if (!displayValue.value) {
    emit('update:modelValue', '');
    return;
  }

  try {
    let value = displayValue.value.replace(/€/g, '').replace(/\s/g, '').trim();
    const numericValue = value.replace(/\./g, '').replace(/,/g, '.');
    if (isNaN(parseFloat(numericValue))) {
      return;
    }

    const number = parseFloat(numericValue);
    const formatted = number.toLocaleString('de-DE', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });

    displayValue.value = formatted;
    emit('update:modelValue', formatted);
  } catch (e) {
    console.error('Error formatting currency:', e);
  }
};

// Update model value when input changes
const handleInput = (event: Event) => {
  const input = event.target as HTMLInputElement;
  displayValue.value = input.value;
  emit('update:modelValue', input.value);
};
</script>

<template>
  <div>
    <label :for="id" class="block text-sm font-medium text-gray-700 mb-1">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>
    <div class="relative">
      <span
        class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"
        >€</span
      >
      <input
        type="text"
        :id="id"
        :name="id"
        :value="displayValue"
        @input="handleInput"
        @blur="handleBlur"
        :required="required"
        class="block w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
      />
    </div>
  </div>
</template>
