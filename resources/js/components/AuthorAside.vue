<script setup lang="ts">
import { MapPin, Briefcase, Calendar, Mail } from 'lucide-vue-next';

import { useFormatDate } from '../composables/useFormatDate';
import UserAvatar from './UserAvatar.vue';

defineProps<{
    name: string;
    avatar?: string | null;
    createdAt?: string | null;
    location?: string | null;
    work?: string | null;
    email?: string | null;
}>();

const { format } = useFormatDate();
</script>

<template>
    <aside class="w-72 shrink-0">
        <div
            class="sticky top-6 space-y-5 rounded-xl border border-t-4 border-border border-t-primary bg-card p-6"
        >
            <div>
                <UserAvatar :avatar="avatar" :name="name" size="lg" />
            </div>

            <hr class="border-border" />

            <!-- Meta fields -->
            <ul class="space-y-3 text-sm">
                <li class="flex items-center gap-2.5 text-muted-foreground">
                    <MapPin class="h-4 w-4 shrink-0 text-primary" />
                    <span v-if="location">{{ location }}</span>
                    <span v-else class="italic opacity-50">Not specified</span>
                </li>
                <li class="flex items-center gap-2.5 text-muted-foreground">
                    <Briefcase class="h-4 w-4 shrink-0 text-primary" />
                    <span v-if="work">{{ work }}</span>
                    <span v-else class="italic opacity-50">Not specified</span>
                </li>
                <li class="flex items-center gap-2.5 text-muted-foreground">
                    <Mail class="h-4 w-4 shrink-0 text-primary" />
                    <a
                        v-if="email"
                        :href="`mailto:${email}`"
                        class="hover:underline"
                        >{{ email }}</a
                    >
                    <span v-else class="italic opacity-50">Not specified</span>
                </li>
                <li class="flex items-center gap-2.5 text-muted-foreground">
                    <Calendar class="h-4 w-4 shrink-0 text-primary" />
                    <span v-if="createdAt">Joined {{ format(createdAt) }}</span>
                    <span v-else class="italic opacity-50">Not specified</span>
                </li>
            </ul>
        </div>
    </aside>
</template>
