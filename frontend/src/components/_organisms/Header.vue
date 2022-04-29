<template>
  <v-app-bar app color="primary" dark>
    <CommonIcon name="logo" height="32" :fill="$vuetify.theme.currentTheme.base" />
  </v-app-bar>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import CommonIcon from '@/components/common/Icon.vue';

@Component({
  components: {
    CommonIcon
  }
})
export default class CommonHeader extends Vue {}
</script>
