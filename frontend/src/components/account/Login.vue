<template>
  <v-form>
    <v-text-field label="メールアドレス または ユーザーID" autocomplete="email" />
    <v-text-field label="パスワード" type="password" autocomplete="current-password" />
    <v-btn type="submit" color="primary">ログインする</v-btn>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class AccountLogin extends Vue {}
</script>
