<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Laptop, LogOut, Settings } from 'lucide-vue-next';
import { dashboard, logout } from '../routes';
import { edit } from '../routes/profile';
import type { User } from '../types';
import ToggleTheme from './ToggleTheme.vue';
import Avatar from './ui/avatar/Avatar.vue';
import AvatarFallback from './ui/avatar/AvatarFallback.vue';
import AvatarImage from './ui/avatar/AvatarImage.vue';
import { Button } from './ui/button';
import DropdownMenu from './ui/dropdown-menu/DropdownMenu.vue';
import DropdownMenuContent from './ui/dropdown-menu/DropdownMenuContent.vue';
import DropdownMenuGroup from './ui/dropdown-menu/DropdownMenuGroup.vue';
import DropdownMenuItem from './ui/dropdown-menu/DropdownMenuItem.vue';

import DropdownMenuLabel from './ui/dropdown-menu/DropdownMenuLabel.vue';
import DropdownMenuSeparator from './ui/dropdown-menu/DropdownMenuSeparator.vue';
import DropdownMenuTrigger from './ui/dropdown-menu/DropdownMenuTrigger.vue';

type Props = {
    user: User;
};

defineProps<Props>();
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon" class="rounded-full">
                <Avatar>
                    <AvatarImage :src="user.avatar ?? ''" />
                    <AvatarFallback>{{
                        user.name
                            ?.split(' ')
                            .map((n) => n[0])
                            .join('')
                            .substring(0, 2)
                            .toUpperCase()
                    }}</AvatarFallback>
                </Avatar>
            </Button>
        </DropdownMenuTrigger>

        <DropdownMenuContent class="w-52">
            <DropdownMenuGroup>
                <DropdownMenuLabel class="px-0 font-normal">
                    <div class="flex flex-col gap-0.5 px-2">
                        <span class="font-medium">{{ user.name }}</span>
                        <span class="text-xs text-muted-foreground">{{
                            user.email
                        }}</span>
                    </div>
                </DropdownMenuLabel>
                <DropdownMenuSeparator />
                <DropdownMenuItem :as-child="true">
                    <Link
                        class="block w-full cursor-pointer"
                        :href="dashboard()"
                        prefetch
                    >
                        <Laptop class="h-4 w-4" /> Dashboard
                    </Link>
                </DropdownMenuItem>
                <DropdownMenuItem :as-child="true">
                    <Link
                        class="block w-full cursor-pointer"
                        :href="edit()"
                        prefetch
                    >
                        <Settings class="h-4 w-4" />
                        Settings
                    </Link>
                </DropdownMenuItem>
                <DropdownMenuSeparator />
                <DropdownMenuItem :as-child="true">
                    <ToggleTheme />
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuGroup>
                <DropdownMenuSeparator />

                <DropdownMenuItem>
                    <Link
                        class="flex w-full cursor-pointer items-center text-left"
                        :href="logout()"
                        method="post"
                        as="button"
                    >
                        <LogOut class="mr-2 h-4 w-4" />
                        Logout
                    </Link>
                </DropdownMenuItem>
            </DropdownMenuGroup>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
