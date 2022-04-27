<template>
  <v-row no-gutters justify="center">
    <v-card class="pa-4" width="400px">
      <v-card-title>ログイン</v-card-title>
      <v-card-text>
        アカウントを作っていなければ、
        <router-link :to="{ name: 'AccountCreate' }">新しく登録する</router-link>
        必要があります。
      </v-card-text>
      <AccountLogin />
    </v-card>
  </v-row>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import AccountLogin from '@/components/account/Login.vue';

@Component({
  components: {
    AccountLogin
  }
})
export default class ViewAccountLogin extends Vue {}
</script>
