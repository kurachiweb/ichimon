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
import { Origin, FetchApiJson } from '@/controlers/_connect/fetch';
import { ReqGetAccount, ResGetAccount } from '@/controlers/account/account';
import { ReqLoginAccount, ResLoginAccount } from '@/controlers/account/login';

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
    this.requestAccountCreate(this.account)
      .then((account?: Account) => {
        if (account == undefined) {
          return Promise.reject();
        }
        // アカウントを作成できた場合、同じ入力値で即ログインする
        return this.requestAccountLogin(this.account);
      })
      .then((loginInfo?: ResLoginAccount) => {
        if (!loginInfo || loginInfo.login !== true || loginInfo.account_id == null) {
          return;
        }
        // アカウントにログインできた場合、即メールアドレスの認証リクエストを送信
        this.requestAccountEmailVerify(loginInfo?.account_id);
        this.$router.push({ name: 'Home' });
      });
  }

  /** アカウント作成リクエストを送信 */
  private requestAccountCreate(account: Account): Promise<Account | undefined> {
    return new Promise(resolve => {
      FetchApiJson<ReqGetAccount, ResGetAccount>(Origin.backend + '/api/accounts', { account }).then(res => {
        resolve(res.data?.account);
      });
    });
  }

  /** アカウントのメールアドレス認証リクエストを送信 */
  private requestAccountEmailVerify(accountId: number) {
    FetchApiJson<null, ResGetAccount>(Origin.backend + '/api/verify/email/send/' + accountId);
  }

  /** アカウントログインリクエストを送信 */
  private requestAccountLogin(account: Account): Promise<ResLoginAccount | undefined> {
    return new Promise(resolve => {
      FetchApiJson<ReqLoginAccount, ResLoginAccount>(Origin.backend + '/api/accounts/login', {
        name: account.auth?.email,
        password: account.auth?.password
      }).then(res => {
        resolve(res.data);
      });
    });
  }
}
</script>
