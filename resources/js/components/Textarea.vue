<script setup lang="ts">
import { useAttrs } from 'vue';

defineOptions({
    inheritAttrs: false,
});

defineProps<{
    placeholder?: string;
}>();

const attrs = useAttrs();
</script>

<template>
    <div class="border-b border-border py-4">
        <textarea
            v-bind="attrs"
            :placeholder="placeholder"
            class="flex field-sizing-content min-h-16 w-full rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50 aria-invalid:border-destructive aria-invalid:ring-destructive/20 md:text-sm dark:bg-input/30 dark:aria-invalid:ring-destructive/40"
        />
    </div>
</template>
