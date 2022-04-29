import Vue from 'vue';
import VueRouter, { Route, RouteConfig } from 'vue-router';

Vue.use(VueRouter);

/** デフォルトのページタイトルと説明文 */
export const DEFAULT_META = {
  title: '一問 ／ Ichimon',
  titleSuffix: ' | 一問アンケート',
  description: 'Webアンケートサービスの、一問です。忙しい日々の合間に、十秒で回答できます。'
};

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "home" */ '@/views/HomeView.vue'),
    meta: { title: 'ホーム' }
  },
  {
    path: '/account/create',
    name: 'AccountCreate',
    component: () => import(/* webpackChunkName: "account_create" */ '@/views/account/Create.vue'),
    meta: { title: 'アカウントを作成' }
  },
  {
    path: '/account/login',
    name: 'AccountLogin',
    component: () => import(/* webpackChunkName: "account_login" */ '@/views/account/Login.vue'),
    meta: { title: 'ログイン' }
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '@/views/AboutView.vue'),
    meta: { title: '一問について' }
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

/** ルーティング情報により、ページタイトルや説明文を変更する */
const changeTitleDescription = (route: Route) => {
  // ページタイトルの設定
  if (typeof route.meta?.title === 'string') {
    document.title = route.meta.title + DEFAULT_META.titleSuffix;
  } else {
    document.title = DEFAULT_META.title;
  }
  const metaDescElem: HTMLMetaElement | null = document.querySelector('meta[name=description]');
  if (metaDescElem) {
    // ページ説明文の設定
    if (typeof route.meta?.description === 'string') {
      metaDescElem.content = route.meta.description;
    } else {
      metaDescElem.content = DEFAULT_META.description;
    }
  }
};

router.afterEach(to => {
  changeTitleDescription(to);
});

export default router;
