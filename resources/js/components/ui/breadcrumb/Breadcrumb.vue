<script lang="ts" setup>
import type { HTMLAttributes } from "vue"

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
defineOptions({
  inheritAttrs: false,
})
</script>

<template>
  <nav
    aria-label="breadcrumb"
    v-bind="$attrs"
    :class="props.class"
  >
    <slot />
  </nav>
</template>
