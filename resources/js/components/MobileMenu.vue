<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Menu } from 'lucide-vue-next';

import { ref, onMounted, onBeforeUnmount } from 'vue';
import {
    Sheet,
    SheetTrigger,
    SheetContent,
    SheetHeader,
} from '@/components/ui/sheet';
import ActionBtnsNav from './ActionBtnsNav.vue';

const open = ref(false);

function handleResize() {
    if (window.innerWidth >= 768) {
        open.value = false;
    }
}

onMounted(() => {
    window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize);
});

withDefaults(
    defineProps<{
        navLinks: { label: string; href: string }[];
        canRegister: boolean;
    }>(),
    {
        navLinks: () => [],
        canRegister: true,
    },
);
</script>

<template>
    <Sheet v-model:open="open">
        <SheetTrigger><Menu /></SheetTrigger>
        <SheetContent side="left">
            <SheetHeader class="mt-24 flex flex-col items-center gap-4">
                <Link
                    v-for="link in navLinks"
                    :key="link.label"
                    :href="link.href"
                    class="font-bold text-foreground transition-colors hover:text-muted-foreground"
                >
                    {{ link.label }}
                </Link>
                <ActionBtnsNav :canRegister="canRegister" />
            </SheetHeader>
        </SheetContent>
    </Sheet>
</template>
