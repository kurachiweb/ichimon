<template>
  <PCard>
    <template #title>アカウントを作成</template>
    <template #content>
      アカウントを持っていますか？
      <NuxtLink :to="{ name: 'account-login' }">ログイン画面へ</NuxtLink>
      <AccountCreate />
    </template>
  </PCard>
</template>
