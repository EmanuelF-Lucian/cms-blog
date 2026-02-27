<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import HeroFeaturedPost from '../components/blog/HeroFeaturedPost.vue';
import Navbar from '../components/blog/Navbar.vue';
import RecentPosts from '../components/blog/RecentPosts.vue';
import SidebarFeaturedPosts from '../components/blog/SidebarFeaturedPosts.vue';
import type { Post } from '../types/post';

defineProps<{
    recentPosts: Post[];
    sidebarPosts: Post[];
    featuredPost: Post;
}>();

// --- Mock Data ---
</script>

<template>
    <Head title="Welcome to Blog" />

    <div class="min-h-screen bg-background">
        <!-- Navbar -->
        <Navbar :canRegister="true" />

        <!-- Main Content -->
        <main class="mx-auto max-w-7xl px-6 py-10">
            <!-- Hero Section -->
            <section>
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

            <!-- Recent Posts Section -->
            <RecentPosts :posts="recentPosts" />
        </main>

        <!-- Footer -->
        <footer class="mt-16 border-t border-border">
            <div
                class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-muted-foreground sm:flex-row"
            >
                <span
                    >© {{ new Date().getFullYear() }} Blog. All rights
                    reserved.</span
                >
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
