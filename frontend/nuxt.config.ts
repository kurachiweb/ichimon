import vuetify from 'vite-plugin-vuetify';

export default defineNuxtConfig({
  css: ['vuetify/lib/styles/main.sass'],
  build: {
    transpile: ['vuetify']
  },
  hooks: {
    'vite:extendConfig': config => {
      config.plugins!.push(vuetify());
    }
  }
});
