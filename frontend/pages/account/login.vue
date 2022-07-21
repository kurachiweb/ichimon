<template>
  <v-row no-gutters justify="center">
    <v-card class="pa-4" width="400px">
      <v-card-title>ログイン</v-card-title>
      <v-card-text>
        アカウントを作っていなければ、
        <NuxtLink :to="{ name: 'account-create' }">新しく登録する</NuxtLink>
        必要があります。
      </v-card-text>
      <AccountLogin />
    </v-card>
  </v-row>
</template>
