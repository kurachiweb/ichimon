import Vue from 'vue';
import VueRouter, { RouteConfig } from 'vue-router';

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "home" */ '@/views/HomeView.vue')
  },
  {
    path: '/account/create',
    name: 'AccountCreate',
    component: () => import(/* webpackChunkName: "account_create" */ '@/views/account/Create.vue')
  },
  {
    path: '/account/login',
    name: 'AccountLogin',
    component: () => import(/* webpackChunkName: "account_login" */ '@/views/account/Login.vue')
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '@/views/AboutView.vue')
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

export default router;
