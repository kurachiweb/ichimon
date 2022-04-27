<template>
  <v-row no-gutters justify="center">
    <v-card class="pa-4" width="400px">
      <v-card-title>アカウントを作成</v-card-title>
      <v-card-text>
        アカウントを持っていますか？
        <router-link :to="{ name: 'AccountLogin' }">ログイン画面へ</router-link>
      </v-card-text>
      <AccountCreate />
    </v-card>
  </v-row>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import AccountCreate from '@/components/account/Create.vue';

@Component({
  components: {
    AccountCreate
  }
})
export default class ViewAccountCreate extends Vue {}
</script>
