import { Vuetify } from 'nuxt/dist/app/compat/capi';
import { createVuetify, ThemeDefinition } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import '@mdi/font/scss/materialdesignicons.scss';

const themeLight: ThemeDefinition = {
  dark: false,
  colors: {
    background: '#FFFFFF',
    surface: '#FFFFFF',
    text: '#2B2C03',
    primary: '#FBFF3C',
    'primary-darken-1': '#D9DD2B',
    secondary: '#03DAC6',
    'secondary-darken-1': '#05bfae',
    error: '#B00020',
    info: '#2196F3',
    success: '#4CAF50',
    warning: '#FB8C00'
  }
};

/** Vuetifyの現在のテーマ定義から色を取得 */
export const vCurrentTheme = (instance: Vuetify, colorKey: string) => {
  const current = unref(instance.theme.current);
  return current.colors[colorKey];
};

export default defineNuxtPlugin(nuxtApp => {
  const vuetify = createVuetify({
    components,
    directives,
    theme: {
      defaultTheme: 'light',
      themes: {
        light: themeLight
      }
    }
  });

  nuxtApp.vueApp.use(vuetify);
});
