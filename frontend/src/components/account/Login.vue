<template>
  <v-form>
    <CommonTextField label="メールアドレス または ユーザーID" autocomplete="email" />
    <CommonTextField label="パスワード" type="password" autocomplete="current-password" />
    <CommonButton type="submit">ログインする</CommonButton>
  </v-form>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import CommonButton from '@/components/_atoms/Button.vue';
import CommonTextField from '@/components/_atoms/TextField.vue';

@Component({
  components: {
    CommonButton,
    CommonTextField
  }
})
export default class AccountLogin extends Vue {}
</script>
