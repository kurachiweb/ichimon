<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <CommonIcon name="logo" height="32" :fill="$vuetify.theme.currentTheme.base" />

      <v-spacer></v-spacer>

      <v-btn href="https://github.com/vuetifyjs/vuetify/releases/latest" target="_blank" text>
        <span class="mr-2">Latest Release</span>
        <v-icon>mdi-open-in-new</v-icon>
      </v-btn>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import CommonIcon from '@/components/common/Icon.vue';

@Component({
  components: {
    CommonIcon
  }
})
export default class App extends Vue {}
</script>
