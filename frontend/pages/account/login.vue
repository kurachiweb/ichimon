<template>
  <PCard>
    <template #title>ログイン</template>
    <template #content>
      アカウントを作っていなければ、
      <NuxtLink :to="{ name: 'account-create' }">新しく登録する</NuxtLink>
      必要があります。
      <AccountLogin />
    </template>
  </PCard>
</template>
