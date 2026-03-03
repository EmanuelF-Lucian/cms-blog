<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { show } from '../../routes/posts';
import type { Post } from '../../types/post';
import Avatar from '../ui/avatar/Avatar.vue';
import AvatarFallback from '../ui/avatar/AvatarFallback.vue';
import AvatarImage from '../ui/avatar/AvatarImage.vue';
import Button from '../ui/button/Button.vue';

// import { Avatar, AvatarImage, AvatarFallback } from '@/components/ui/avatar';

defineProps<{
    post: Post;
}>();
</script>

<template>
    <Link
        :href="show(post.slug).url"
        class="group flex flex-col overflow-hidden rounded-xl border border-border bg-card text-card-foreground shadow-sm transition-shadow hover:shadow-md"
    >
        <!-- Post Image -->
        <div class="h-48 w-full overflow-hidden bg-muted">
            <img
                :src="post.main_image?.path ?? 'https://picsum.photos/1200/630'"
                :alt="post.title"
                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
            />
        </div>

        <!-- Card Body -->
        <div class="flex flex-1 flex-col p-4">
            <!-- Title -->
            <h3
                class="mt-1 line-clamp-2 text-base leading-snug font-semibold text-card-foreground transition-colors group-hover:text-primary"
            >
                {{ post.title }}
            </h3>

            <!-- Description -->
            <p class="mt-2 mb-3 line-clamp-2 text-sm text-muted-foreground">
                {{ post.excerpt }}
            </p>

            <!-- Author row -->
            <div
                class="mt-auto flex items-center gap-2 border-t border-border pt-3"
            >
                <Button
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-input bg-background"
                >
                    <Avatar>
                        <AvatarImage :src="post.user?.avatar ?? ''" />
                        <AvatarFallback>{{
                            post.user?.name?.charAt(0) ?? ''
                        }}</AvatarFallback>
                    </Avatar>
                </Button>

                <span class="text-sm font-medium text-card-foreground">{{
                    post.user?.name
                }}</span>
                <span class="ml-auto text-xs text-muted-foreground"
                    >{{ post.reading_time }} min read</span
                >
            </div>
        </div>
    </Link>
</template>
