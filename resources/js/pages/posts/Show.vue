<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// ─── Wayfinder imports (placeholder — înlocuiește cu path-urile generate) ───
// import { store as storeComment } from '@/actions/App/Http/Controllers/CommentController';
// import { store as storeReply } from '@/actions/App/Http/Controllers/ReplyController';

import AuthorAside from '../../components/AuthorAside.vue';
import CommentCard from '../../components/CommentCard.vue';
import CommentForm from '../../components/CommentForm.vue';
import EngagementBar from '../../components/EngagementBar.vue';
import Button from '../../components/ui/button/Button.vue';
import UserAvatar from '../../components/UserAvatar.vue';
import { useFormatDate } from '../../composables/useFormatDate';
import FrontendLayout from '../../layouts/FrontendLayout.vue';
import type { Post } from '../../types/post';
import type { Tag } from '../../types/tag';

defineProps<{
    post: Post;
    tags: Tag[];
}>();

defineOptions({
    layout: FrontendLayout,
});

interface ReplyTarget {
    parentId: number;
    replyToId: number;
    replyToName: string;
}

const commentFormOpen = ref(false);
const replyTarget = ref<ReplyTarget | null>(null);

const commentForm = useForm({ content: '' });
const replyForm = useForm({ content: '' });

const cancelComment = () => {
    commentFormOpen.value = false;
    commentForm.reset();
};

const submitComment = (postId: number) => {
    commentForm.post(`/posts/${postId}/comments`, {
        preserveScroll: true,
        onSuccess: () => {
            commentForm.reset();
            commentFormOpen.value = false;
        },
        onError: () => {
            // Errors are available via commentForm.errors
            // Optionally show a toast or inline error
        },
    });
};

const openReply = (
    parentId: number,
    replyToId: number,
    replyToName: string,
) => {
    if (
        replyTarget.value?.replyToId === replyToId &&
        replyTarget.value?.parentId === parentId
    ) {
        replyTarget.value = null;
        replyForm.reset();
        return;
    }
    replyTarget.value = { parentId, replyToId, replyToName };
    replyForm.reset();
};

const cancelReply = () => {
    replyTarget.value = null;
    replyForm.reset();
};

const submitReply = (parentId: number) => {
    replyForm.post(`/comments/${parentId}/replies`, {
        preserveScroll: true,
        onSuccess: () => {
            replyForm.reset();
            replyTarget.value = null;
        },
    });
};
const { format } = useFormatDate();
</script>

<template>
    <Head :title="post.title" />

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="flex items-start justify-between gap-16">
            <!-- ── Main column ── -->
            <div class="min-w-0 flex-1 space-y-6">
                <h1
                    class="text-3xl font-extrabold tracking-tight text-foreground"
                >
                    {{ post.title }}
                </h1>

                <div class="flex flex-col gap-3 border-b border-border pb-4">
                    <UserAvatar
                        :avatar="post.user.avatar"
                        :name="post.user.name"
                        size="lg"
                    />
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-muted-foreground">
                            Posted at {{ format(post.created_at) }}
                        </span>

                        <span
                            v-if="post.reading_time"
                            class="text-xs text-muted-foreground"
                            >{{ post.reading_time }} min read</span
                        >
                    </div>
                </div>

                <EngagementBar
                    :likes="post.likes_count"
                    :comments="post.comments_count"
                />

                <article class="space-y-6 border-b border-border pb-6">
                    <div
                        v-if="post.main_image?.path"
                        class="aspect-video overflow-hidden rounded-lg"
                    >
                        <img
                            :src="post.main_image?.path"
                            :alt="post.title"
                            class="h-full w-full object-cover"
                        />
                    </div>
                    <div
                        v-html="post.content"
                        class="text-justify leading-relaxed text-foreground"
                    />
                    <div class="flex flex-wrap gap-2">
                        <Button
                            v-for="tag in tags"
                            :key="tag.id"
                            variant="secondary"
                            class="rounded-full text-xs"
                        >
                            {{ tag.name }}
                        </Button>
                    </div>
                </article>

                <article class="space-y-6">
                    <h2
                        class="flex items-center gap-2 border-b border-border pb-4 text-xl font-bold text-foreground"
                    >
                        Top Comments
                        <span
                            class="inline-flex h-6 min-w-6 items-center justify-center rounded-full bg-primary px-2 text-xs font-bold text-primary-foreground"
                        >
                            {{ post.comments_count }}
                        </span>
                    </h2>

                    <CommentForm
                        v-model="commentForm.content"
                        :open="commentFormOpen"
                        :processing="commentForm.processing"
                        placeholder="Leave a comment…"
                        @open="commentFormOpen = true"
                        @submit="submitComment(post.id)"
                        @cancel="cancelComment"
                    />

                    <div class="space-y-4">
                        <CommentCard
                            v-for="comment in post.comments"
                            :key="comment.id"
                            :comment="comment"
                            :reply-target="replyTarget"
                            :reply-form-value="replyForm.content"
                            :reply-form-processing="replyForm.processing"
                            @open-reply="openReply"
                            @update:reply-form-value="
                                replyForm.content = $event
                            "
                            @submit-reply="submitReply"
                            @cancel-reply="cancelReply"
                        />
                    </div>
                </article>
            </div>

            <!-- ── Aside column ── -->
            <AuthorAside
                :name="post.user.name"
                :avatar="post.user.avatar ?? null"
                :created-at="post.user.created_at ?? null"
                :location="
                    (post.user.location as string | null | undefined) ?? null
                "
                :work="(post.user.work as string | null | undefined) ?? null"
                :email="(post.user.email as string | null | undefined) ?? null"
            />
        </div>
    </div>
</template>
