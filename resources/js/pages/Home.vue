<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import HeroFeaturedPost from '../components/blog/HeroFeaturedPost.vue';
import Navbar from '../components/blog/Navbar.vue';
import PostCard from '../components/blog/PostCard.vue';
import RecentPosts from '../components/blog/RecentPosts.vue';
import SidebarFeaturedPosts from '../components/blog/SidebarFeaturedPosts.vue';

import type { Post } from '../types/post';

const props = defineProps<{
    recentPosts: Post[];
    sidebarPosts: Post[];
    featuredPost: Post | null;
    canRegister: boolean;
}>();
const fallbackPosts = props.recentPosts.slice(0, 3);
</script>

<template>
    <Head title="Welcome to Blog" />

    <div class="min-h-screen bg-background">
        <!-- Navbar -->
        <Navbar :canRegister="canRegister" />

        <!-- Main Content -->
        <main class="mx-auto max-w-7xl px-6 py-10">
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
                    <h2 class="text-2xl font-bold tracking-tight">
                        Editor’s Picks
                    </h2>
                </div>
                <PostCard
                    v-for="post in fallbackPosts"
                    :key="post.id"
                    :post="post"
                />
            </section>

            <!-- Recent Posts Section -->
            <RecentPosts :posts="recentPosts" />
        </main>

        <!-- Footer -->
        <footer class="mt-16 border-t border-border">
            <div
                class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-muted-foreground sm:flex-row"
            >
                <span>
                    © {{ new Date().getFullYear() }} Blog. All rights reserved.
                </span>
                <div class="flex gap-5">
                    <a href="#" class="transition-colors hover:text-foreground"
                        >Privacy</a
                    >
                    <a href="#" class="transition-colors hover:text-foreground"
                        >Terms</a
                    >
                    <a href="#" class="transition-colors hover:text-foreground"
                        >Contact</a
                    >
                </div>
            </div>
        </footer>
    </div>
</template>
