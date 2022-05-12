<template>
  <v-form @submit.prevent="onSubmitLogin()">
    <CommonTextField v-model="accountName" label="メールアドレス または アカウントID" autocomplete="email" />
    <CommonTextField v-model="accountPassword" label="パスワード" type="password" autocomplete="current-password" />
    <CommonButton type="submit">ログインする</CommonButton>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Account } from '@/models/account/account';

@Component
export default class AccountLogin extends Vue {
  /** メールアドレスまたはアカウントID */
  private accountName = '';
  /** パスワード */
  private accountPassword = '';

  /** 送信ボタンのクリック後 */
  private onSubmitLogin() {
    this.requestAccountLogin(this.accountName, this.accountPassword).then(console.log);
    // this.$router.push({ name: 'Home' });
  }

  /** アカウントログインリクエストを送信 */
  private requestAccountLogin(name: string, password: string): Promise<Account> {
    return new Promise(resolve => {
      fetch('http://127.0.0.1:55002/api/accounts/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        mode: 'cors',
        credentials: 'include',
        body: JSON.stringify({
          name: name,
          password: password
        })
      })
        .then(r => r.json())
        .then(res => {
          resolve(res.data.account);
        });
    });
  }
}
</script>
