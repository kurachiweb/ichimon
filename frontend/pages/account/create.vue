<template>
  <v-row no-gutters justify="center">
    <v-card class="pa-4" width="400px">
      <v-card-title>アカウントを作成</v-card-title>
      <v-card-text>
        アカウントを持っていますか？
        <NuxtLink :to="{ name: 'account-login' }">ログイン画面へ</NuxtLink>
      </v-card-text>
      <AccountCreate />
    </v-card>
  </v-row>
</template>
