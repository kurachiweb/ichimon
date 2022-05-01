<template>
  <v-form @submit.prevent="requestCreate()">
    <CommonTextField v-model="account.display_id" label="アカウントID" autocomplete="username" />
    <CommonTextField v-model="account.auth.email" label="メールアドレス" type="email" autocomplete="email" />
    <CommonTextField v-model="account.auth.password" label="パスワード" type="password" autocomplete="new-password" />
    <CommonButton type="submit">この内容で登録する</CommonButton>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { DefaultAccount } from '@/models/account/account';

@Component
export default class AccountCreate extends Vue {
  private account = DefaultAccount(true);

  /** アカウント作成リクエストを送信 */
  private requestCreate() {
    fetch('http://127.0.0.1:55002/api/accounts', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(this.account)
    })
      .then(r => r.json())
      .then(console.log);
  }
}
</script>
