<script setup lang="ts">
const props = defineProps<{
  currentPage: number;
  totalPages: number;
}>();

const emit = defineEmits<{
  (e: 'page-change', page: number): void;
}>();

const nextPage = () => {
  if (props.currentPage < props.totalPages) {
    emit('page-change', props.currentPage + 1);
  }
};

const prevPage = () => {
  if (props.currentPage > 1) {
    emit('page-change', props.currentPage - 1);
  }
};

const goToPage = (page: number) => {
  emit('page-change', page);
};
</script>

<template>
  <div class="flex justify-between items-center" v-if="totalPages > 1">
    <button
      @click="prevPage"
      :disabled="currentPage === 1"
      :class="[
        'px-3 py-1 rounded',
        currentPage === 1
          ? 'bg-gray-200 text-gray-500 cursor-not-allowed'
          : 'bg-gray-200 hover:bg-gray-300 text-gray-700',
      ]"
    >
      Previous
    </button>

    <div class="flex space-x-1">
      <button
        v-for="page in totalPages"
        :key="page"
        @click="goToPage(page)"
        :class="[
          'px-3 py-1 rounded',
          currentPage === page
            ? 'bg-blue-600 text-white'
            : 'bg-gray-200 hover:bg-gray-300 text-gray-700',
        ]"
      >
        {{ page }}
      </button>
    </div>

    <button
      @click="nextPage"
      :disabled="currentPage === totalPages"
      :class="[
        'px-3 py-1 rounded',
        currentPage === totalPages
          ? 'bg-gray-200 text-gray-500 cursor-not-allowed'
          : 'bg-gray-200 hover:bg-gray-300 text-gray-700',
      ]"
    >
      Next
    </button>
  </div>
</template>
