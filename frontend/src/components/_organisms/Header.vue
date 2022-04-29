<template>
  <v-app-bar app color="primary">
    <router-link :to="{ name: 'Home' }">
      <CommonIcon name="logo" height="32" :fill="$vuetify.theme.currentTheme.base" />
    </router-link>
  </v-app-bar>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import CommonIcon from '@/components/_molecules/Icon.vue';

@Component({
  components: {
    CommonIcon
  }
})
export default class CommonHeader extends Vue {}
</script>
