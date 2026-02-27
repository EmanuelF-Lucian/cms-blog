<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import type { Post } from '../../types/post';

defineProps<{
    post: Post;
}>();
</script>

<template>
    <a
        href="#"
        class="group relative block h-100 overflow-hidden rounded-xl lg:h-110"
    >
        <!-- Background Image -->
        <img
            :src="
                post.main_image?.path ??
                'https://placeholdpicsum.dev/photo/1200/630'
            "
            :alt="post.title"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
        />

        <!-- Gradient overlay — always dark regardless of theme (on top of image) -->
        <div
            class="absolute inset-0 bg-linear-to-t from-black/75 via-black/10 to-transparent"
        />

        <!-- Content -->
        <div class="absolute right-0 bottom-0 left-0 p-6">
            <Badge
                v-for="(tag, index) in post.tags"
                :key="index"
                variant="outline"
                class="mb-3 border-white/30 bg-black/30 text-xs font-medium text-white backdrop-blur-sm"
            >
                {{ tag }}
            </Badge>
            <h2
                class="text-2xl leading-tight font-semibold text-white lg:text-3xl"
            >
                {{ post.title }}
            </h2>
        </div>
    </a>
</template>
