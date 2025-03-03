<script setup lang="ts">
defineProps<{
  adviserName: string;
  csrfToken: string;
}>();
</script>

<template>
  <div class="dashboard max-w-lg mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-gray-800">
        Welcome, {{ adviserName }}!
      </h1>
      <span class="text-sm text-gray-500">{{
        new Date().toLocaleDateString()
      }}</span>
    </div>

    <div class="space-y-4 mb-6">
      <a
        href="/clients"
        class="flex items-center justify-between bg-blue-50 hover:bg-blue-100 border border-blue-200 p-4 rounded-lg group transition-colors duration-200"
      >
        <div class="flex items-center">
          <img
            src="/icons/clients.svg"
            alt="Clients"
            class="h-6 w-6 text-blue-600 mr-3"
          />
          <span class="font-medium text-gray-800">View All Clients</span>
        </div>
        <img
          src="/icons/chevron-right.svg"
          alt="Arrow"
          class="h-5 w-5 text-blue-600 group-hover:translate-x-1 transition-transform duration-200"
        />
      </a>

      <a
        href="/report"
        class="flex items-center justify-between bg-green-50 hover:bg-green-100 border border-green-200 p-4 rounded-lg group transition-colors duration-200"
      >
        <div class="flex items-center">
          <img
            src="/icons/reports.svg"
            alt="Reports"
            class="h-6 w-6 text-green-600 mr-3"
          />
          <span class="font-medium text-gray-800">View Report</span>
        </div>
        <img
          src="/icons/chevron-right.svg"
          alt="Arrow"
          class="h-5 w-5 text-green-600 group-hover:translate-x-1 transition-transform duration-200"
        />
      </a>
    </div>

    <form action="/logout" method="POST" class="mt-8">
      <input type="hidden" name="_token" :value="csrfToken" />
      <button
        type="submit"
        class="w-full flex items-center justify-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-lg transition-colors duration-200"
      >
        <img src="/icons/logout.svg" alt="Logout" class="h-5 w-5" />
        <span class="font-medium">Logout</span>
      </button>
    </form>
  </div>
</template>
