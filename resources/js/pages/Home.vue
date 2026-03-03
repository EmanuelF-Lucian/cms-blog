<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import HeroFeaturedPost from '../components/blog/HeroFeaturedPost.vue';

import PostCard from '../components/blog/PostCard.vue';
import RecentPosts from '../components/blog/RecentPosts.vue';
import SidebarFeaturedPosts from '../components/blog/SidebarFeaturedPosts.vue';

import FrontendLayout from '../layouts/FrontendLayout.vue';
import type { Post } from '../types/post';

const props = defineProps<{
    recentPosts: Post[];
    sidebarPosts: Post[];
    featuredPost: Post | null;
    canRegister: boolean;
}>();

defineOptions({
    layout: FrontendLayout,
});

const fallbackPosts = props.recentPosts.slice(0, 3);
</script>

<template>
    <Head title="Welcome to Blog" />

    <!-- Hero Section -->
    <section v-if="featuredPost">
        <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-3">
            <!-- Featured Post (2/3 width on desktop) -->
            <div class="lg:col-span-2">
                <HeroFeaturedPost :post="featuredPost" />
            </div>

            <!-- Sidebar Featured Posts (1/3 width on desktop) -->
            <div class="lg:col-span-1">
                <SidebarFeaturedPosts :posts="sidebarPosts" />
            </div>
        </div>
    </section>

    <!-- Fallback: Editor’s Picks -->
    <section v-else class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div
            class="col-span-1 mb-4 flex items-center justify-between md:col-span-3"
        >
            <h2 class="text-2xl font-bold tracking-tight">Editor’s Picks</h2>
        </div>
        <PostCard v-for="post in fallbackPosts" :key="post.id" :post="post" />
    </section>

    <!-- Recent Posts Section -->
    <RecentPosts :posts="recentPosts" />
</template>
