<template>
  <v-form>
    <CommonTextField label="ユーザーID" autocomplete="username" />
    <CommonTextField label="メールアドレス" type="email" autocomplete="email" />
    <CommonTextField label="パスワード" type="password" autocomplete="new-password" />
    <CommonButton type="submit">この内容で登録する</CommonButton>
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
export default class AccountCreate extends Vue {}
</script>
