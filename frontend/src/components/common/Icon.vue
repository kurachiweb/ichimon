<template>
  <CommonSvg :path="singlePath" :viewBox="viewBox" />
</template>

<script lang="ts">
import { Component, Vue, Prop } from 'vue-property-decorator';
import { ICON } from '@/components/types/icons';
import CommonSvg from '@/components/common/Svg.vue';

@Component({
  components: {
    CommonSvg
  }
})
export default class CommonIcon extends Vue {
  @Prop() name!: keyof typeof ICON; // アイコン名
  @Prop({ default: '0 0 512 512' }) viewBox!: string; // SVGの仮想描画サイズ

  /** アイコン名から単一パス属性値に */
  private get singlePath(): string {
    return ICON[this.name] ?? '';
  }
}
</script>
