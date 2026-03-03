<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import ActionBtnsNav from '../ActionBtnsNav.vue';
import AppLogo from '../AppLogo.vue';
import MobileMenu from '../MobileMenu.vue';

withDefaults(
    defineProps<{
        canRegister?: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const navLinks = [
    { label: 'Homepage', href: '/' },
    { label: 'Posts', href: '/posts' },
    { label: 'About', href: '#about' },
    { label: 'Contact', href: '#contact' },
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
            <AppLogo />

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
