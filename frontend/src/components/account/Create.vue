<template>
  <v-form @submit.prevent="onSubmitCreate()">
    <CommonTextField v-model="account.display_id" label="アカウントID" autocomplete="username" />
    <CommonTextField v-model="account.auth.email" label="メールアドレス" type="email" autocomplete="email" />
    <CommonTextField v-model="account.auth.password" label="パスワード" type="password" autocomplete="new-password" />
    <CommonButton type="submit">この内容で登録する</CommonButton>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Account, DefaultAccount } from '@/models/account/account';

@Component
export default class AccountCreate extends Vue {
  private account = DefaultAccount(true);

  /** Cookieからキー指定で値を取得する */
  private getCookie(key: string): string | null {
    const cookies = document.cookie.split(',');
    for (const cookie of cookies) {
      const keyValue = cookie.split('=');
      if (keyValue[0] === key) {
        return keyValue[1];
      }
    }
    return null;
  }

  /** 送信ボタンのクリック後 */
  private onSubmitCreate() {
    this.requestAccountCreate(this.account).then((account: Account) => {
      this.requestAccountEmailVerify(account);
      this.requestAccountLogin(this.account);
      this.$router.push({ name: 'Home' });
    });
  }

  /** アカウント作成リクエストを送信 */
  private requestAccountCreate(account: Account): Promise<Account> {
    return new Promise(resolve => {
      fetch('http://127.0.0.1:55002/api/accounts', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(account)
      })
        .then(r => r.json())
        .then(res => {
          resolve(res.data.account);
        });
    });
  }

  /** アカウントのメールアドレス認証リクエストを送信 */
  private requestAccountEmailVerify(account: Account) {
    fetch('http://127.0.0.1:55002/api/verify/email/send/' + account.id)
      .then(r => r.json())
      .then(console.log);
  }

  /** アカウントログインリクエストを送信 */
  private requestAccountLogin(account: Account): Promise<Account> {
    return new Promise(resolve => {
      fetch('http://127.0.0.1:55002/api/accounts/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          name: account.auth?.email,
          password: account.auth?.password
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
