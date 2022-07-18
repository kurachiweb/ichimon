<template>
  <PButton v-bind="$attrs">
    <slot />
  </PButton>
</template>

<script lang="ts">
export default defineNuxtComponent({
  name: 'CommonButton'
});
</script>
