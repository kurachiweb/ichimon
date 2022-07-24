<template>
  <v-form @submit.prevent="onSubmitCreate()">
    <CommonTextField
      v-model="account.nickname"
      label="ニックネーム"
      autocomplete="username"
    />
    <CommonTextField
      v-model="account.email"
      label="メールアドレス"
      type="email"
      autocomplete="email"
    />
    <CommonTextField
      v-model="account.password"
      label="パスワード"
      type="password"
      autocomplete="new-password"
    />
    <CommonButton type="submit">この内容で登録する</CommonButton>
  </v-form>
</template>

<script lang="ts" setup>
import {
  DefaultReqCreateAccount,
  requestCreateAccount
} from '@/controlers/account/create';
import { requestLoginAccount } from '@/controlers/account/login';
import { requestAccountEmailConfirm } from '@/controlers/account/verify-email';

const account = DefaultReqCreateAccount();

const onSubmitCreate = () => {
  requestCreateAccount(account)
    .then(() => {
      // アカウントを作成できた場合、同じ入力値で即ログインする
      return requestLoginAccount(account.email, account.password);
    })
    .then(loginInfo => {
      if (loginInfo?.account_id == null) {
        return;
      }
      // アカウントにログインできた場合、即メールアドレスの認証リクエストを送信
      requestAccountEmailConfirm(loginInfo.account_id);
      navigateTo({ name: 'index' });
    });
};
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'AccountCreate'
});
</script>
