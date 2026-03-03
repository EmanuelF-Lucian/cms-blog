<script setup lang="ts">
import { computed } from 'vue';
import { useFormatDate } from '../composables/useFormatDate';
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

const sizeKey = computed(() => props.size ?? 'md');

const { format } = useFormatDate();
</script>

<template>
    <div class="flex items-center gap-2">
        <Button variant="outline" size="icon" class="rounded-full">
            <Avatar>
                <AvatarImage :src="avatar ?? ''" />
                <AvatarFallback>{{
                    name
                        ?.split(' ')
                        .map((n) => n[0])
                        .join('')
                        .substring(0, 2)
                        .toUpperCase()
                }}</AvatarFallback>
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
                format(date)
            }}</span>
        </div>
    </div>
</template>
