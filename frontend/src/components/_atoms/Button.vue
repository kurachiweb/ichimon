<template>
  <v-btn v-bind="$attrs" :color="color">
    <slot />
  </v-btn>
</template>

<script lang="ts">
import { Component, Vue, Prop } from 'vue-property-decorator';

@Component
export default class CommonButton extends Vue {
  @Prop({ default: 'primary darken-2' }) color!: string; // ボタンのテーマ色
}
</script>
