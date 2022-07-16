// Styles
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import 'vuetify/styles';
import '@mdi/font/scss/materialdesignicons.scss';

export default defineNuxtPlugin(nuxtApp => {
  const vuetify = createVuetify({
    components
  });

  nuxtApp.vueApp.use(vuetify);
});
