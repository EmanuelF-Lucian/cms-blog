<script setup lang="ts">
import Navbar from '../components/blog/Navbar.vue';

defineProps<{
    canRegister?: boolean;
}>();
</script>

<template>
    <div class="grid min-h-screen grid-rows-[auto_1fr_auto] bg-background">
        <!-- Navbar -->
        <Navbar :canRegister="canRegister" />

        <!-- Main Content -->
        <main class="mx-auto w-full max-w-7xl px-6 py-10">
            <slot />
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
