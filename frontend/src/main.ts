import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import 'roboto-fontface/css/roboto/roboto-fontface.css';
import '@mdi/font/css/materialdesignicons.css';

Vue.config.productionTip = false;

// 共通コンポーネント群：Atoms
/** 共通ボタン */
import CommonButton from '@/components/_atoms/Button.vue';
Vue.component('CommonButton', CommonButton);
/** 共通SVG */
import CommonSvg from '@/components/_atoms/Svg.vue';
Vue.component('CommonSvg', CommonSvg);
/** 共通テキスト入力 */
import CommonTextField from '@/components/_atoms/TextField.vue';
Vue.component('CommonTextField', CommonTextField);

// 共通コンポーネント群：Molecules
/** 共通アイコン */
import CommonIcon from '@/components/_molecules/Icon.vue';
Vue.component('CommonIcon', CommonIcon);

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app');
