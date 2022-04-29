<template>
  <svg>
    <slot />
    <path v-if="path" :d="path" />
  </svg>
</template>

<script lang="ts">
import { Component, Vue, Prop } from 'vue-property-decorator';

@Component
export default class CommonSvg extends Vue {
  @Prop() path?: string; // 単一パス属性値
}
</script>
