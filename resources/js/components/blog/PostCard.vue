<script setup lang="ts">
// import { Avatar, AvatarImage, AvatarFallback } from '@/components/ui/avatar';

defineProps<{
    title: string;
    image: string | null;
    excerpt: string | null;
    author: string;
    readTime: number | null;
}>();
</script>

<template>
    <a
        href="#"
        class="group block overflow-hidden rounded-xl border border-border bg-card text-card-foreground shadow-sm transition-shadow hover:shadow-md"
    >
        <!-- Post Image -->
        <div class="h-48 w-full overflow-hidden bg-muted">
            <img
                :src="image ?? '#'"
                :alt="title"
                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
            />
        </div>

        <!-- Card Body -->
        <div class="p-4">
            <!-- Title -->
            <h3
                class="mt-1 line-clamp-2 text-base leading-snug font-semibold text-card-foreground transition-colors group-hover:text-primary"
            >
                {{ title }}
            </h3>

            <!-- Description -->
            <p class="mt-2 line-clamp-2 text-sm text-muted-foreground">
                {{ excerpt }}
            </p>

            <!-- Author row -->
            <!-- <div
                class="mt-4 flex items-center gap-2 border-t border-border pt-3"
            >
                <Avatar class="h-6 w-6">
                    <AvatarImage
                        v-if="authorAvatar"
                        :src="authorAvatar"
                        :alt="authorName"
                    />
                    <AvatarFallback
                        class="bg-muted text-xs text-muted-foreground"
                        >{{ authorName.charAt(0) }}</AvatarFallback
                    >
                </Avatar>
                <span class="text-sm font-medium text-card-foreground">{{
                    authorName
                }}</span>
                <span class="ml-auto text-xs text-muted-foreground">{{
                    readTime
                }}</span>
            </div> -->
        </div>
    </a>
</template>
