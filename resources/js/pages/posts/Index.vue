<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PostCard from '../../components/blog/PostCard.vue';
import Pagination from '../../components/Pagination.vue';
import FrontendLayout from '../../layouts/FrontendLayout.vue';
import type { Post } from '../../types/post';

defineProps<{
    posts: {
        data: Post[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}>();

defineOptions({
    layout: FrontendLayout,
});
</script>

<template>
    <Head title="All Posts" />
    <h1 class="text-3xl font-bold">All Posts</h1>
    <div class="mt-16 grid items-stretch gap-4 md:grid-cols-2 lg:grid-cols-3">
        <PostCard v-for="post in posts.data" :key="post.id" :post="post" />
    </div>
    <div class="mt-8 justify-self-end">
        <Pagination :links="posts.links" />
    </div>
</template>
