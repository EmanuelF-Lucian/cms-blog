<script setup lang="ts">
import Avatar from './ui/avatar/Avatar.vue';
import AvatarFallback from './ui/avatar/AvatarFallback.vue';
import AvatarImage from './ui/avatar/AvatarImage.vue';
import Button from './ui/button/Button.vue';

const props = defineProps<{
    avatar?: string | null;
    name: string;
    date?: string;

    size?: 'sm' | 'md' | 'lg';
}>();

const textSizeClass = {
    sm: 'text-xs',
    md: 'text-sm',
    lg: 'text-base',
} as const;

const sizeKey = props.size ?? 'md';
</script>

<template>
    <div class="flex items-center gap-2">
        <Button variant="outline" size="icon" class="rounded-full">
            <Avatar>
                <AvatarImage :src="avatar ?? ''" />
                <AvatarFallback>{{ name.charAt(0) }}</AvatarFallback>
            </Avatar>
        </Button>
        <div class="flex flex-col gap-0.5">
            <span
                class="leading-none font-semibold text-foreground"
                :class="textSizeClass[sizeKey]"
            >
                {{ name }}
            </span>
            <span v-if="date" class="text-xs text-muted-foreground">{{
                date
            }}</span>
        </div>
    </div>
</template>
