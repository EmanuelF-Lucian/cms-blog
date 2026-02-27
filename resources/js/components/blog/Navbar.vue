<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import ActionBtnsNav from '../ActionBtnsNav.vue';
import MobileMenu from '../MobileMenu.vue';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const navLinks = [
    { label: 'Homepage', href: '/' },
    { label: 'About us', href: '#about' },
    { label: 'Features', href: '#features' },
    { label: 'Blog', href: '#blog' },
    { label: 'Contact us', href: '#contact' },
];
</script>

<template>
    <nav
        class="sticky top-0 z-50 border-b border-border bg-background/80 backdrop-blur-sm"
    >
        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4"
        >
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <div
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-foreground"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="h-4 w-4 text-background"
                    >
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                    </svg>
                </div>
                <span
                    class="text-base font-semibold tracking-tight text-foreground"
                    >Beyond UI</span
                >
            </div>

            <!-- Nav Links (desktop) -->
            <nav class="hidden items-center gap-7 lg:flex">
                <Link
                    v-for="link in navLinks"
                    :key="link.label"
                    :href="link.href"
                    class="text-sm font-medium text-foreground transition-colors hover:text-muted-foreground"
                >
                    {{ link.label }}
                </Link>
            </nav>

            <!-- Actions -->
            <div class="hidden items-center gap-2 lg:flex">
                <ActionBtnsNav :canRegister="canRegister" />
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center lg:hidden">
                <MobileMenu :navLinks="navLinks" :canRegister="canRegister" />
            </div>
        </div>
    </nav>
</template>
