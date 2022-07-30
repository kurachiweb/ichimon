import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives'
import '@mdi/font/scss/materialdesignicons.scss';

export default defineNuxtPlugin(nuxtApp => {
  const vuetify = createVuetify({
    components,
    directives
  });

  nuxtApp.vueApp.use(vuetify);
});