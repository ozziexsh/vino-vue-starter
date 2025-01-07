<script setup lang="ts">
import { useSlots } from 'vue';

const slots = useSlots();
</script>

<template>
  <p v-if="slots.default" class="text-sm text-red-400">
    <slot />
  </p>
</template>
