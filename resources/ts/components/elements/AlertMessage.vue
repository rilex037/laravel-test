<script setup lang="ts">
const props = defineProps<{
  type: 'success' | 'error' | 'warning' | 'info';
  message?: string | null;
  errors?: Record<string, string[]> | null;
}>();

const getAlertClasses = () => {
  switch (props.type) {
    case 'success':
      return 'bg-green-50 border-green-200 text-green-700';
    case 'error':
      return 'bg-red-50 border-red-200 text-red-700';
    case 'warning':
      return 'bg-yellow-50 border-yellow-200 text-yellow-700';
    case 'info':
      return 'bg-blue-50 border-blue-200 text-blue-700';
    default:
      return 'bg-gray-50 border-gray-200 text-gray-700';
  }
};
</script>

<template>
  <div
    v-if="message || (errors && Object.keys(errors).length > 0)"
    class="border px-4 py-3 rounded-lg mb-6"
    :class="getAlertClasses()"
  >
    <p v-if="message">{{ message }}</p>
    <ul v-if="errors && Object.keys(errors).length > 0">
      <li v-for="(errorArray, field) in errors" :key="field">
        {{ errorArray[0] }}
      </li>
    </ul>
  </div>
</template>
