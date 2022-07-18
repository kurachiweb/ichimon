<template>
  <form @submit.prevent="onSubmitLogin()">
    <CommonTextField
      v-model="accountName"
      label="メールアドレス または アカウントID"
      autocomplete="email"
    />
    <CommonTextField
      v-model="accountPassword"
      label="パスワード"
      type="password"
      autocomplete="current-password"
    />
    <CommonButton type="submit">ログインする</CommonButton>
  </form>
</template>

<script lang="ts" setup>
import { requestLoginAccount } from '@/controlers/account/login';

const accountName = '';
const accountPassword = '';

const onSubmitLogin = () => {
  // アカウントにログイン
  requestLoginAccount(accountName, accountPassword).then(() => {
    navigateTo({ name: 'Home' });
  });
};
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'AccountLogin'
});
</script>
