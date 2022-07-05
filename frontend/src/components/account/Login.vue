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

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { requestAccountLogin } from '@/controlers/account/account';

@Component
export default class AccountLogin extends Vue {
  /** メールアドレスまたはアカウントID */
  private accountName = '';
  /** パスワード */
  private accountPassword = '';

  /** 送信ボタンのクリック後 */
  private onSubmitLogin() {
    // アカウントにログイン
    requestAccountLogin(this.accountName, this.accountPassword).then(() => {
      this.$router.push({ name: 'Home' });
    });
  }
}
</script>
