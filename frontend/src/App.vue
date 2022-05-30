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
import { Origin } from '@/controlers/_connect/fetch';
import CommonHeader from '@/components/_organisms/Header.vue';

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
      this.requestCheckEmail(String(emailVerifyToken));
      this.$router.push({ name: this.$route.name || 'Home' });
    }
  }

  /** アカウントのメールアドレス認証リクエストを送信 */
  private requestCheckEmail(token: string) {
    fetch(Origin.backend + '/api/verify/email/check', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ token })
    })
      .then(r => r.json())
      .then(console.log);
  }
}
</script>
