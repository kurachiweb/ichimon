<template>
  <v-form>
    <v-text-field label="ユーザーID" autocomplete="username" />
    <v-text-field label="メールアドレス" type="email" />
    <v-text-field label="パスワード" type="password" autocomplete="new-password" />
    <v-btn type="submit" color="primary">この内容で登録する</v-btn>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class AccountCreate extends Vue {}
</script>
