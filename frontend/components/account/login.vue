<template>
  <v-form @submit.prevent="onSubmitLogin()">
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
  </v-form>
</template>

<script lang="ts" setup>
import { requestLoginAccount } from '@/controlers/account/login';

const accountName = ref('');
const accountPassword = ref('');

const onSubmitLogin = () => {
  // アカウントにログイン
  requestLoginAccount(accountName.value, accountPassword.value).then(() => {
    navigateTo({ name: 'index' });
  });
};
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'AccountLogin'
});
</script>
