<template>
  <v-btn v-bind="$attrs">
    <slot />
  </v-btn>
</template>

<script lang="ts">
export default defineNuxtComponent({
  name: 'CommonButton'
});
</script>
