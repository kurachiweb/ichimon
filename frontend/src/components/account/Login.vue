<template>
  <v-form @submit.prevent="onSubmitLogin()">
    <CommonTextField v-model="accountName" label="メールアドレス または アカウントID" autocomplete="email" />
    <CommonTextField v-model="accountPassword" label="パスワード" type="password" autocomplete="current-password" />
    <CommonButton type="submit">ログインする</CommonButton>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Origin, FetchApiJson } from '@/controlers/_connect/fetch';
import { ReqLoginAccount, ResLoginAccount } from '@/controlers/account/login';

@Component
export default class AccountLogin extends Vue {
  /** メールアドレスまたはアカウントID */
  private accountName = '';
  /** パスワード */
  private accountPassword = '';

  /** 送信ボタンのクリック後 */
  private onSubmitLogin() {
    this.requestAccountLogin(this.accountName, this.accountPassword).then(() => {
      this.$router.push({ name: 'Home' });
    });
  }

  /** アカウントログインリクエストを送信 */
  private requestAccountLogin(name: string, password: string): Promise<ResLoginAccount | undefined> {
    return new Promise(resolve => {
      FetchApiJson<ReqLoginAccount, ResLoginAccount>(
        Origin.backend + '/api/accounts/login',
        {
          name,
          password
        },
        { method: 'POST' }
      ).then(res => {
        resolve(res.data);
      });
    });
  }
}
</script>
