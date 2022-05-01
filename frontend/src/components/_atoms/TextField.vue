<template>
  <v-text-field v-bind="$attrs" v-model="Value">
    <slot />
  </v-text-field>
</template>

<script lang="ts">
import { Component, Emit, Prop, Vue } from 'vue-property-decorator';

@Component
export default class CommonTextField extends Vue {
  @Prop() value!: string; // 入力値

  @Emit()
  private input(newValue: string) {
    return newValue;
  }

  private get Value() {
    return this.value;
  }
  private set Value(newValue: string) {
    this.input(newValue);
  }
}
</script>
