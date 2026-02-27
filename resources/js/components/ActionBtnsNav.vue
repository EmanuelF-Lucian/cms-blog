<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { login, register } from '../routes';

import HomeUserMenu from './HomeUserMenu.vue';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <div v-if="$page.props.auth.user">
        <HomeUserMenu :user="$page.props.auth.user" />
    </div>
    <template v-else>
        <Link :href="login()" as="button">
            <Button variant="outline" class="font-medium">Login</Button>
        </Link>
        <Link v-if="canRegister" :href="register()" as="button">
            <Button class="font-medium">Register</Button>
        </Link>
    </template>
</template>
