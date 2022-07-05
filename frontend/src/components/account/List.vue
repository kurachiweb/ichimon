<template>
  <div>
    <v-card v-for="account of accounts" :key="account.id" class="mb-8">
      <v-card-title>{{ account.nickname }}</v-card-title>
      <v-card-text>{{ account.display_id }}</v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Prop } from 'vue-property-decorator';
import AccountList from '@/components/account/List.vue';
import { Account } from '@/models/account/account';

@Component({
  components: {
    AccountList
  }
})
export default class ViewAccountLogin extends Vue {
  /** アカウント一覧 */
  @Prop({ default: () => [] }) accounts!: Account[];
}
</script>
