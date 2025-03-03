<script setup lang="ts">
import type { Client } from '@/types/Client';
import { ref, watch, computed } from 'vue';
import { parseJsonData } from '@/utils/jsonParser';
import CurrencyInput from '@/components/elements/CurrencyInput.vue';
import AlertMessage from '@/components/elements/AlertMessage.vue';
import FormField from '@/components/elements/FormField.vue';
import { convertCentsToCurrency, convertCurrencyToCents } from '@/utils/currencyHelpers';

const successMessage = ref<string | null>(
  document
    .querySelector('meta[name="success-message"]')
    ?.getAttribute('content') || null
);
const errors = ref<Record<string, string[]> | null>(
  document.querySelector('meta[name="errors"]')?.getAttribute('content')
    ? parseJsonData<Record<string, string[]>>(
        document.querySelector('meta[name="errors"]')!.getAttribute('content')!
      )
    : null
);

const props = defineProps<{
  client: string | null;
  action: string;
  method: string;
  csrfToken: string;
  adviserId: string;
}>();

const parsedClient = computed(() =>
  props.client ? parseJsonData<Client>(props.client) : null
);

const isEdit = computed(() => props.method === 'PUT');

const form = ref({
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  cash_loan_amount: '',
  property_value: '',
  down_payment_amount: '',
});

// Convert form values back to cents before submission
const handleSubmit = (event: Event) => {
  form.value.cash_loan_amount = form.value.cash_loan_amount ? 
    convertCurrencyToCents(form.value.cash_loan_amount).toString() : '';
  form.value.property_value = form.value.property_value ? 
    convertCurrencyToCents(form.value.property_value).toString() : '';
  form.value.down_payment_amount = form.value.down_payment_amount ? 
    convertCurrencyToCents(form.value.down_payment_amount).toString() : '';
};

// Initialize form data from client data, converting cents to formatted currency
watch(
  () => parsedClient.value,
  (client) => {
    if (client) {
      form.value = {
        first_name: client.first_name,
        last_name: client.last_name,
        email: client.email || '',
        phone: client.phone || '',
        cash_loan_amount: client.cash_loan_amount ? 
          convertCentsToCurrency(client.cash_loan_amount) : '',
        property_value: client.property_value ? 
          convertCentsToCurrency(client.property_value) : '',
        down_payment_amount: client.down_payment_amount ? 
          convertCentsToCurrency(client.down_payment_amount) : '',
      };
    }
  },
  { immediate: true }
);
</script>

<template>
  <div class="client-form max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
      {{ isEdit ? 'Edit Client' : 'Create New Client' }}
    </h1>

    <AlertMessage 
      v-if="successMessage" 
      :message="successMessage" 
      type="success" 
    />

    <AlertMessage 
      v-if="errors && Object.keys(errors).length > 0" 
      :errors="errors" 
      type="error" 
    />

    <form
      :action="action"
      method="POST"
      @submit="handleSubmit"
      class="bg-white rounded-lg shadow-sm border border-gray-200 p-6"
    >
      <input type="hidden" name="_token" :value="csrfToken" />
      <input v-if="isEdit" type="hidden" name="_method" value="PUT" />

      <div class="grid grid-cols-1 gap-6">
        <FormField
          id="first_name"
          label="First Name"
          v-model="form.first_name"
          required
        />

        <FormField
          id="last_name"
          label="Last Name"
          v-model="form.last_name"
          required
        />

        <FormField
          id="email"
          label="Email"
          type="email"
          v-model="form.email"
        />

        <FormField
          id="phone"
          label="Phone"
          v-model="form.phone"
        />

        <div class="mt-6">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Cash Loan Application</h2>
          <div class="grid grid-cols-1 gap-6">
            <CurrencyInput
              id="cash_loan_amount"
              label="Loan Amount"
              v-model="form.cash_loan_amount"
            />
          </div>
        </div>

        <div class="mt-6">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Home Loan Application</h2>
          <div class="grid grid-cols-1 gap-6">
            <CurrencyInput
              id="property_value"
              label="Property Value"
              v-model="form.property_value"
            />
            
            <CurrencyInput
              id="down_payment_amount"
              label="Down Payment"
              v-model="form.down_payment_amount"
            />
          </div>
        </div>

        <div class="flex space-x-4 mt-6">
          <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200"
          >
            {{ isEdit ? 'Update Client' : 'Create Client' }}
          </button>
          <a
            href="/clients"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg transition-colors duration-200"
          >
            Cancel
          </a>
        </div>
      </div>
    </form>
  </div>
</template>