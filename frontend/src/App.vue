<template>
  <v-app>
    <CommonHeader />
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { Origin, FetchApiJson } from '@/controlers/_connect/fetch';
import CommonHeader from '@/components/_organisms/Header.vue';
import { ReqVerifyEmail, ResVerifyEmail } from '@/controlers/account/verify-email';

@Component({
  components: {
    CommonHeader
  }
})
export default class App extends Vue {
  mounted() {
    /** メールアドレス認証のURLから来た場合 */
    const emailVerifyToken = this.$route.query.email_token;
    if (emailVerifyToken) {
      this.requestCheckEmail(String(emailVerifyToken)).then(() => {
        // メールアドレスを認証できてもできなくても、URLからクエリ文字列を取り除く
        this.$router.push({ name: this.$route.name || 'Home' });
      });
    }
  }

  /** アカウントのメールアドレス認証リクエストを送信 */
  private requestCheckEmail(token: string): Promise<ResVerifyEmail | undefined> {
    return new Promise(resolve => {
      FetchApiJson<ReqVerifyEmail, ResVerifyEmail>(
        Origin.backend + '/api/verify/email/check',
        { token }
      ).then(res => {
        resolve(res.data);
      });
    });
  }
}
</script>
