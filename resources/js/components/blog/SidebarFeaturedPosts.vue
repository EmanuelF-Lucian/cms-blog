<script setup lang="ts">
import type { Post } from '../../types/post';

defineProps<{
    posts: Post[];
}>();
</script>

<template>
    <div class="flex h-full flex-col">
        <h3 class="mb-4 text-base font-semibold text-foreground">
            Other featured posts
        </h3>
        <ul class="flex flex-col divide-y divide-border">
            <li v-for="post in posts.slice(0, 6)" :key="post.id">
                <a href="#" class="group flex items-start gap-3 py-3">
                    <!-- Thumbnail -->
                    <div
                        class="h-14 w-14 shrink-0 overflow-hidden rounded-md bg-muted"
                    >
                        <img
                            :src="
                                post.main_image?.path ??
                                'https://placeholdpicsum.dev/photo/1200/630'
                            "
                            :alt="post.title"
                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                        />
                    </div>
                    <!-- Title -->
                    <p
                        class="line-clamp-3 text-sm leading-snug font-medium text-foreground transition-colors group-hover:text-primary"
                    >
                        {{ post.title }}
                    </p>
                </a>
            </li>
        </ul>
    </div>
</template>
