<template>
  <CommonSvg v-bind="$attrs" :path="presetPath" :viewBox="props.viewBox" />
</template>

<script lang="ts" setup>
import { ICON } from '@/types/icons';

type Props = {
  name: keyof typeof ICON; // アイコン名
  viewBox?: string; // SVGの仮想描画サイズ
};
const props = withDefaults(defineProps<Props>(), {
  viewBox: '0 0 512 512'
});

/** アイコン名から単一パス属性値に */
const presetPath = computed(() => ICON[props.name]);
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'CommonSvg'
});
</script>
