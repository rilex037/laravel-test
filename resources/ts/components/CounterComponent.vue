<script setup lang="ts">
import { useInitialState } from '@/utils/getInitialState';
import { ref } from 'vue';

const count = useInitialState('datainitialcount', 0);

const increment = () => count.value++;
const decrement = () => count.value--;
</script>

<template>
  <div class="counter">
    <p class="text-lg font-semibold">Count: {{ count }}</p>
    <button
      @click="increment"
      class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
    >
      Increment
    </button>
    <button
      @click="decrement"
      class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
    >
      Decrement
    </button>
  </div>
</template>
