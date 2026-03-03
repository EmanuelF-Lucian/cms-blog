<script setup lang="ts">
import { ThumbsUp, MessageSquare } from 'lucide-vue-next';

defineProps<{
    likes: number;
    comments: number;
}>();
</script>

<template>
    <div
        class="flex w-fit items-center gap-4 rounded-lg border border-border bg-card px-4 py-2 text-sm font-medium text-card-foreground"
    >
        <span class="flex items-center gap-1.5">
            <ThumbsUp class="h-4 w-4 text-primary" />
            {{ likes }}
        </span>
        <span class="h-4 w-px bg-border" />
        <span class="flex items-center gap-1.5">
            <MessageSquare class="h-4 w-4 text-primary" />
            {{ comments }}
        </span>
    </div>
</template>
