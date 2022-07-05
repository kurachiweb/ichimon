import Vue from 'vue';
import VueRouter, { Route, RouteConfig } from 'vue-router';

import ViewHome from '@/views/Home.vue';
import ViewAccountCreate from '@/views/account/Create.vue';
import ViewAccountLogin from '@/views/account/Login.vue';
import ViewAccountList from '@/views/account/List.vue';

Vue.use(VueRouter);

/** デフォルトのページタイトルと説明文 */
export const DEFAULT_META = {
  title: '一問 ／ Ichimon',
  titleSuffix: ' | 一問アンケート',
  description:
    'Webアンケートサービスの、一問です。忙しい日々の合間に、十秒で回答できます。'
};

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Home',
    component: ViewHome,
    meta: { title: 'ホーム' }
  },
  {
    path: '/account/create',
    name: 'AccountCreate',
    component: ViewAccountCreate,
    meta: { title: 'アカウントを作成' }
  },
  {
    path: '/account/login',
    name: 'AccountLogin',
    component: ViewAccountLogin,
    meta: { title: 'ログイン' }
  },
  {
    path: '/account/list',
    name: 'AccountList',
    component: ViewAccountList,
    meta: { title: 'アカウント一覧' }
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
  const metaDescElem: HTMLMetaElement | null = document.querySelector(
    'meta[name=description]'
  );
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
