<template>
  <div>
    <v-icon large color="orange darken-2">mdi-arrow-up-bold-box-outline</v-icon>
    <p>{{ hoge }}</p>
    <p>tophunter</p>
  </div>
</template>

<script lang="ts">
export default {
  data: () => ({
    hoge: 'テスト'
  })
};
</script>
