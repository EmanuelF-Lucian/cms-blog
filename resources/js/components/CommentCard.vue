<script setup lang="ts">
import { ThumbsUp, MessageSquare } from 'lucide-vue-next';

import CommentForm from './CommentForm.vue';
import ReplyCard, { type Reply } from './ReplyCard.vue';
import Button from './ui/button/Button.vue';
import UserAvatar from './UserAvatar.vue';

export interface Comment {
    id: number;
    content: string;
    created_at: string;
    likes_count: number;
    replies_count: number;
    replies?: Reply[];
    user: {
        name: string;
        avatar?: string | null;
    };
}

interface ReplyTarget {
    parentId: number;
    replyToId: number;
    replyToName: string;
}

defineProps<{
    comment: Comment;
    replyTarget: ReplyTarget | null;
    replyFormValue: string;
    replyFormProcessing?: boolean;
}>();

const emit = defineEmits<{
    'open-reply': [parentId: number, replyToId: number, replyToName: string];
    'update:replyFormValue': [value: string];
    'submit-reply': [parentId: number];
    'cancel-reply': [];
}>();
</script>

<template>
    <div
        class="space-y-3 rounded-lg border border-border bg-card p-4 transition-shadow hover:shadow-md"
    >
        <!-- Header -->
        <UserAvatar
            :avatar="comment.user.avatar"
            :name="comment.user.name"
            :date="comment.created_at"
            size="md"
        />

        <!-- Body -->
        <p class="text-sm leading-relaxed text-card-foreground">
            {{ comment.content }}
        </p>

        <!-- Actions -->
        <div class="flex items-center gap-1">
            <Button
                variant="ghost"
                class="flex items-center gap-1.5 px-2 py-1 text-xs text-muted-foreground hover:text-primary"
            >
                <ThumbsUp class="h-4 w-4" />
                {{ comment.likes_count }}
            </Button>
            <Button
                variant="ghost"
                class="flex items-center gap-1.5 px-2 py-1 text-xs text-muted-foreground hover:text-primary"
                :class="
                    replyTarget?.parentId === comment.id &&
                    replyTarget?.replyToId === comment.id
                        ? 'bg-accent text-primary'
                        : ''
                "
                @click="
                    emit(
                        'open-reply',
                        comment.id,
                        comment.id,
                        comment.user.name,
                    )
                "
            >
                <MessageSquare class="h-4 w-4" />
                {{ comment.replies_count }}
            </Button>
        </div>

        <!-- Replies + forms -->
        <div
            v-if="
                (comment.replies && comment.replies.length) ||
                replyTarget?.parentId === comment.id
            "
            class="ml-3 border-l-2 border-border pl-4"
        >
            <ReplyCard
                v-for="reply in comment.replies"
                :key="reply.id"
                :reply="reply"
                :reply-form-open="replyTarget?.replyToId === reply.id"
                :reply-form-value="
                    replyTarget?.replyToId === reply.id ? replyFormValue : ''
                "
                :reply-form-processing="replyFormProcessing"
                @open-reply="
                    (replyId, replyToName) =>
                        emit('open-reply', comment.id, replyId, replyToName)
                "
                @update:reply-form-value="emit('update:replyFormValue', $event)"
                @submit-reply="emit('submit-reply', comment.id)"
                @cancel-reply="emit('cancel-reply')"
            />

            <!-- Form reply direct la comentariu -->
            <Transition
                enter-active-class="transition-all duration-200 ease-out"
                enter-from-class="opacity-0 -translate-y-1"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-150 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-1"
            >
                <div
                    v-if="replyTarget?.replyToId === comment.id"
                    class="border-l-2 border-primary pt-3 pl-3"
                >
                    <CommentForm
                        :model-value="replyFormValue"
                        :open="true"
                        :processing="replyFormProcessing"
                        :replying-to="comment.user.name"
                        placeholder="Leave a reply…"
                        @update:model-value="
                            emit('update:replyFormValue', $event)
                        "
                        @open="() => {}"
                        @submit="emit('submit-reply', comment.id)"
                        @cancel="emit('cancel-reply')"
                    />
                </div>
            </Transition>
        </div>
    </div>
</template>
