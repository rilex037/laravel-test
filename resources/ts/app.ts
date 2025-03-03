import { defineCustomElement } from 'vue';
import Dashboard from '@/components/Dashboard.vue';
import ClientsList from '@/components/ClientsList.vue';

customElements.define(
  'adviser-dashboard',
  defineCustomElement(Dashboard, { shadowRoot: false })
);
customElements.define(
  'clients-list',
  defineCustomElement(ClientsList, { shadowRoot: false })
);
