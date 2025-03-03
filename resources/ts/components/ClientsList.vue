<script setup lang="ts">
import type { Client } from '@/types/Client';
import { computed, ref } from 'vue';
import Pagination from '@/components/elements/Pagiantion.vue';
import { parseJsonData } from '@/utils/jsonParser';

const props = defineProps<{
  clientsData: string;
  csrfToken: string;
}>();

const clients = computed(() => parseJsonData<Client[]>(props.clientsData));

// Pagination logic
const itemsPerPage = 10;
const currentPage = ref(1);
const totalPages = computed(() =>
  Math.ceil(clients.value.length / itemsPerPage)
);
const paginatedClients = computed(() => {
  const startIndex = (currentPage.value - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  return clients.value.slice(startIndex, endIndex);
});

const handlePageChange = (page: number) => {
  currentPage.value = page;
};
</script>

<template>
  <div class="clients-list max-w-4xl mx-auto p-6">
    <div
      class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4"
    >
      <h1 class="text-2xl font-bold text-gray-800">All Clients</h1>
      <div class="space-x-2">
        <a
          href="/dashboard"
          class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200"
        >
          Back to Dashboard
        </a>
        <a
          href="/clients/create"
          class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200"
        >
          Create Client
        </a>
      </div>
    </div>

    <div v-if="clients.length === 0" class="text-center py-8">
      <p class="text-gray-600">No clients found.</p>
    </div>

    <div v-else>
      <div class="grid grid-cols-1 gap-4">
        <div
          v-for="client in paginatedClients"
          :key="client.id"
          class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden"
        >
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
              {{ client.first_name }} {{ client.last_name }}
            </h3>

            <div class="grid grid-cols-1 gap-2 mb-4">
              <div class="flex">
                <span class="text-gray-500 w-32">Email:</span>
                <span class="text-gray-800">{{ client.email || '-' }}</span>
              </div>
              <div class="flex">
                <span class="text-gray-500 w-32">Phone:</span>
                <span class="text-gray-800">{{ client.phone || '-' }}</span>
              </div>
              <div class="flex">
                <span class="text-gray-500 w-32">Cash Loan:</span>
                <span class="text-gray-800">{{
                  client.has_cash_loan ? 'Yes' : 'No'
                }}</span>
              </div>
              <div class="flex">
                <span class="text-gray-500 w-32">Home Loan:</span>
                <span class="text-gray-800">{{
                  client.has_home_loan ? 'Yes' : 'No'
                }}</span>
              </div>
            </div>

            <div class="flex space-x-2 mt-2">
              <a
                :href="`/clients/${client.id}/edit`"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-1 px-3 rounded transition-colors duration-200"
              >
                Edit
              </a>
              <form
                :action="`/clients/${client.id}`"
                method="POST"
                class="inline"
              >
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="_token" :value="csrfToken" />
                <button
                  type="submit"
                  class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium py-1 px-3 rounded transition-colors duration-200"
                  onclick="return confirm('Are you sure you want to delete this client?')"
                >
                  Delete
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6">
        <Pagination
          :current-page="currentPage"
          :total-pages="totalPages"
          @page-change="handlePageChange"
        />
      </div>
    </div>
  </div>
</template>
