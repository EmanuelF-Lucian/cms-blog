<script setup lang="ts">
import { useColorMode, useCycleList } from '@vueuse/core';
import { Laptop, MoonIcon, SunIcon } from 'lucide-vue-next';
import { watchEffect } from 'vue';

const mode = useColorMode({
    emitAuto: true,
    modes: {
        contrast: 'dark contrast',
        cafe: 'cafe',
    },
});

const { state, next } = useCycleList(['dark', 'light', 'auto'] as const, {
    initialValue: mode,
});

watchEffect(() => (mode.value = state.value));

const handleClick = () => next();
</script>

<template>
    <!-- Va fi folosit în DropdownMenuItem -->
    <div class="flex cursor-pointer items-center gap-2" @click="handleClick">
        <MoonIcon v-if="state === 'dark'" class="h-4 w-4" />
        <SunIcon v-if="state === 'light'" class="h-4 w-4" />
        <Laptop v-if="state === 'auto'" class="h-4 w-4" />

        <span class="text-sm">Theme</span>
    </div>
</template>
