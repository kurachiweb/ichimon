<template>
  <svg class="common_svg">
    <path v-if="props.path" :d="props.path" />
  </svg>
</template>

<script lang="ts" setup>
type Props = {
  path?: string; // 単一パス属性値
};
const props = defineProps<Props>();
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'CommonSvg'
});
</script>

<style lang="scss" scoped>
.common_svg {
  vertical-align: middle;
}
</style>
