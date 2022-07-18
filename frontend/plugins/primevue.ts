import { defineNuxtPlugin } from '#app';
import PrimeVue from 'primevue/config';
import Button from 'primevue/button';
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';

export default defineNuxtPlugin(nuxtApp => {
  nuxtApp.vueApp.use(PrimeVue, { ripple: true });
  // 使うコンポーネントを1つ1つ登録する
  nuxtApp.vueApp.component('PButton', Button);
  nuxtApp.vueApp.component('PCard', Card);
  nuxtApp.vueApp.component('PInputText', InputText);
});
