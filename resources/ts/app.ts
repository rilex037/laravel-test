import { defineCustomElement } from 'vue';
import CounterComponent from '@/components/CounterComponent.vue';

customElements.define(
  'counter-component',
  defineCustomElement(CounterComponent, { shadowRoot: false })
);
