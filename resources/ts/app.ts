import { defineCustomElement } from 'vue';
import Dashboard from '@/components/Dashboard.vue';
import ClientsList from '@/components/ClientsList.vue';
import ClientForm from '@/components/ClientForm.vue';

customElements.define(
  'adviser-dashboard',
  defineCustomElement(Dashboard, { shadowRoot: false })
);
customElements.define(
  'clients-list',
  defineCustomElement(ClientsList, { shadowRoot: false })
);
customElements.define(
  'client-form',
  defineCustomElement(ClientForm, { shadowRoot: false })
);
