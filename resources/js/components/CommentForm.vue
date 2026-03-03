<script setup lang="ts">
import { Send, X } from 'lucide-vue-next';
import Button from './ui/button/Button.vue';

defineProps<{
    modelValue: string;
    open: boolean;
    processing?: boolean;
    placeholder?: string;
    replyingTo?: string | null;
}>();

const emit = defineEmits<{
    'update:modelValue': [value: string];
    open: [];
    submit: [];
    cancel: [];
}>();
</script>

<template>
    <div class="space-y-2">
        <!-- Indicator "Replying to" -->
        <p v-if="replyingTo" class="text-xs text-muted-foreground">
            Replying to
            <span class="font-semibold text-primary">@{{ replyingTo }}</span>
        </p>

        <textarea
            :value="modelValue"
            :placeholder="placeholder ?? 'Leave a comment…'"
            rows="2"
            class="flex min-h-12 w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-input/30"
            :class="{ 'bg-muted dark:bg-muted': replyingTo }"
            @input="
                emit(
                    'update:modelValue',
                    ($event.target as HTMLTextAreaElement).value,
                )
            "
            @focus="emit('open')"
            @click="emit('open')"
        />

        <Transition
            enter-active-class="transition-all duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-1"
        >
            <div v-if="open" class="flex justify-end gap-2">
                <Button
                    variant="ghost"
                    class="flex items-center gap-1.5 text-xs text-muted-foreground hover:text-destructive"
                    @click="emit('cancel')"
                >
                    <X class="h-3.5 w-3.5" /> Cancel
                </Button>
                <Button
                    class="flex items-center gap-1.5 text-xs"
                    :disabled="processing || !modelValue.trim()"
                    @click="emit('submit')"
                >
                    <Send class="h-3.5 w-3.5" /> Submit
                </Button>
            </div>
        </Transition>
    </div>
</template>
