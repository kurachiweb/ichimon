<template>
  <PInputText v-bind="$attrs" v-model="Value" type="text" />
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

const handleInput = (value: string) => {
  emit('update:modelValue', value);
};

const Value = computed({
  get(): string {
    return modelValue.value;
  },
  set(value: string) {
    handleInput(value);
  }
});
</script>

<script lang="ts">
export default defineNuxtComponent({
  name: 'CommonTextField'
});
</script>
