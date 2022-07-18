<template>
  <form @submit.prevent="onSubmitCreate()">
    <CommonTextField
      v-model="account.display_id"
      label="アカウントID"
      autocomplete="username"
    />
    <CommonTextField
      v-model="account.auth.email"
      label="メールアドレス"
      type="email"
      autocomplete="email"
    />
    <CommonTextField
      v-model="account.auth.password"
      label="パスワード"
      type="password"
      autocomplete="new-password"
    />
    <CommonButton type="submit">この内容で登録する</CommonButton>
  </form>
</template>

<script lang="ts" setup>
import { DefaultAccount } from '@/models/account/account';
import { requestCreateAccount } from '@/controlers/account/create';
import { requestLoginAccount } from '@/controlers/account/login';
import { requestAccountEmailConfirm } from '@/controlers/account/verify-email';

const account = DefaultAccount(true);

const onSubmitCreate = () => {
  requestCreateAccount(account)
    .then(() => {
      if (account.auth == null) {
        return;
      }
      // アカウントを作成できた場合、同じ入力値で即ログインする
      return requestLoginAccount(account.auth.email, account.auth.password);
    })
    .then(loginInfo => {
      if (loginInfo?.account_id == null) {
        return;
      }
      // アカウントにログインできた場合、即メールアドレスの認証リクエストを送信
      requestAccountEmailConfirm(loginInfo.account_id);
      navigateTo({ name: 'Home' });
    });
};
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'AccountCreate'
});
</script>
