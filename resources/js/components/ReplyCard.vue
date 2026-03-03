<script setup lang="ts">
import { ThumbsUp, MessageSquare, CornerDownRight } from 'lucide-vue-next';

import CommentForm from './CommentForm.vue';
import Button from './ui/button/Button.vue';
import UserAvatar from './UserAvatar.vue';

export interface Reply {
    id: number;
    content: string;
    created_at: string;
    likes_count?: number;
    user: {
        name: string;
        avatar?: string | null;
    };
}

defineProps<{
    reply: Reply;
    replyFormOpen: boolean;
    replyFormValue: string;
    replyFormProcessing?: boolean;
}>();

const emit = defineEmits<{
    'open-reply': [replyId: number, replyToName: string];
    'update:replyFormValue': [value: string];
    'submit-reply': [];
    'cancel-reply': [];
}>();
</script>

<template>
    <div class="space-y-2 border-b border-border/50 py-3 last:border-0">
        <div class="flex items-start gap-2">
            <CornerDownRight
                class="mt-1.5 h-3.5 w-3.5 shrink-0 text-muted-foreground"
            />
            <div class="flex-1 space-y-1.5">
                <UserAvatar
                    :avatar="reply.user.avatar"
                    :name="reply.user.name"
                    :date="reply.created_at"
                    size="sm"
                />
                <p class="text-xs leading-relaxed text-card-foreground">
                    {{ reply.content }}
                </p>
                <div class="flex items-center gap-1">
                    <Button
                        variant="ghost"
                        class="flex items-center gap-1 px-1.5 py-0.5 text-xs text-muted-foreground hover:text-primary"
                    >
                        <ThumbsUp class="h-3.5 w-3.5" />
                        {{ reply.likes_count ?? 0 }}
                    </Button>
                    <Button
                        variant="ghost"
                        class="flex items-center gap-1 px-1.5 py-0.5 text-xs text-muted-foreground hover:text-primary"
                        :class="replyFormOpen ? 'bg-accent text-primary' : ''"
                        @click="emit('open-reply', reply.id, reply.user.name)"
                    >
                        <MessageSquare class="h-3.5 w-3.5" />
                        Reply
                    </Button>
                </div>
            </div>
        </div>

        <!-- Reply form inline -->
        <Transition
            enter-active-class="transition-all duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-1"
        >
            <div
                v-if="replyFormOpen"
                class="ml-5 border-l-2 border-primary pt-1 pl-3"
            >
                <CommentForm
                    :model-value="replyFormValue"
                    :open="replyFormOpen"
                    :processing="replyFormProcessing"
                    :replying-to="reply.user.name"
                    placeholder="Leave a reply…"
                    @update:model-value="emit('update:replyFormValue', $event)"
                    @open="() => {}"
                    @submit="emit('submit-reply')"
                    @cancel="emit('cancel-reply')"
                />
            </div>
        </Transition>
    </div>
</template>
