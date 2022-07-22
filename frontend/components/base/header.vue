<template>
  <v-app-bar app color="primary" class="w-100">
    <NuxtLink :to="{ name: 'index' }">
      <CommonIcon name="logo" height="32" fill="white" />
    </NuxtLink>
  </v-app-bar>
</template>

<script lang="ts">
export default defineNuxtComponent({
  name: 'BaseHeader'
});
</script>
