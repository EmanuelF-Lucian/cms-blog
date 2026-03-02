<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import PostCard from '@/components/blog/PostCard.vue';
import { Button } from '@/components/ui/button';
import type { Post } from '../../types/post';

defineProps<{
    posts: Post[];
}>();
</script>

<template>
    <section class="mt-12">
        <!-- Section Header -->
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-foreground">Recent Posts</h2>
            <Link href="/* posts route */">
                <Button variant="outline" size="sm">All Posts</Button>
            </Link>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <PostCard v-for="post in posts" :key="post.id" :post="post" />
        </div>
    </section>
</template>
