<template>
  <v-form>
    <CommonTextField label="メールアドレス または アカウントID" autocomplete="email" />
    <CommonTextField label="パスワード" type="password" autocomplete="current-password" />
    <CommonButton type="submit">ログインする</CommonButton>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class AccountLogin extends Vue {}
</script>
