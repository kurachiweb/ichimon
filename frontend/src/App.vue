<template>
  <v-app>
    <CommonHeader />
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import CommonHeader from '@/components/_organisms/Header.vue';

@Component({
  components: {
    CommonHeader
  }
})
export default class App extends Vue {}
</script>
