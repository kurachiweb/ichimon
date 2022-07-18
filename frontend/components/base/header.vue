<template>
  <header class="base_header">
    <NuxtLink :to="{ name: 'index' }">
      <CommonIcon name="logo" height="32" fill="white" />
    </NuxtLink>
  </header>
</template>

<script lang="ts">
export default defineNuxtComponent({
  name: 'BaseHeader'
});
</script>

<style lang="scss" scoped>
.base_header {
  background-color: var(--purple-600);
  padding: 12px;
}
</style>
