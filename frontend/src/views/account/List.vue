<template>
  <div>
    <h1>アカウント一覧</h1>
    <AccountList :accounts="accounts" />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import AccountList from '@/components/account/List.vue';
import { requestListingAccount } from '@/controlers/account/list';
import { Account } from '@/models/account/account';

@Component({
  components: {
    AccountList
  }
})
export default class ViewAccountLogin extends Vue {
  /** アカウント一覧 */
  private accounts: Account[] = [];

  created() {
    this.listingAccounts();
  }

  /** 送信ボタンのクリック後 */
  private listingAccounts() {
    // アカウントの一覧を取得
    requestListingAccount().then(res => {
      if (res == null) {
        return;
      }
      this.accounts = res.accounts;
    });
  }
}
</script>
