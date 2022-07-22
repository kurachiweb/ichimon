<template>
  <v-text-field v-bind="$attrs" v-model="fieldValue" variant="outlined">
    <slot />
  </v-text-field>
</template>

<script lang="ts" setup>
type Props = {
  modelValue: string;
};
const props = withDefaults(defineProps<Props>(), {
  modelValue: ''
});
const { modelValue } = toRefs(props);

interface Emits {
  (e: 'update:modelValue', value: string): void;
}
const emit = defineEmits<Emits>();

/** 入力値の保持 */
const fieldValue = ref(modelValue.value);

/** 入力値の変更を反映 */
const handleInput = (value: string) => {
  emit('update:modelValue', value);
};

watch(fieldValue, () => {
  handleInput(fieldValue.value);
});
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'CommonTextField'
});
</script>
