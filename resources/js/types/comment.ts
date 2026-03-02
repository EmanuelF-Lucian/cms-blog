import type { User } from './auth';
import type { Like } from './like';
import type { Post } from './post';

export interface Comment {
    id: number;
    user_id: number;
    post_id: number;
    parent_id: number | null;
    content: string;
    created_at: string;
    updated_at: string;
    user: User;
    post: Post;
    parent: Comment | null;
    likes: Like[];
}
