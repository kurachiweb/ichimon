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
import CommonHeader from '@/components/_organisms/Header.vue';
import { requestAccountEmailVerify } from '@/controlers/account/verify-email';
import { requestGetMaster } from '@/controlers/master/get';

@Component({
  components: {
    CommonHeader
  }
})
export default class App extends Vue {
  created() {
    // マスタ情報を取得
    requestGetMaster();

    /** メールアドレス認証のURLから来た場合 */
    const emailVerifyToken = this.$route.query.email_token;
    if (emailVerifyToken) {
      // @todo この処理はアカウント情報ページに移してaccountIdを指定したい
      requestAccountEmailVerify(0, String(emailVerifyToken)).then(() => {
        // メールアドレスを認証できてもできなくても、URLからクエリ文字列を取り除く
        this.$router.push({ name: this.$route.name || 'Home' });
      });
    }
  }
}
</script>
