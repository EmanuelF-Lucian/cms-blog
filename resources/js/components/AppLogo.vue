<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '../routes';
</script>

<template>
    <Link :href="home().url" class="flex items-center gap-2">
        <div class="flex items-center gap-2">
            <div
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-foreground"
            >
                <AppLogoIcon />
            </div>
            <span class="text-base font-semibold tracking-tight text-foreground"
                >Beyond UI</span
            >
        </div>
    </Link>
</template>
