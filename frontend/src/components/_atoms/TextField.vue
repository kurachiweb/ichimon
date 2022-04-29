<template>
  <v-text-field v-bind="$attrs">
    <slot />
  </v-text-field>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class CommonTextField extends Vue {}
</script>
