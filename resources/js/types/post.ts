import type { User } from './auth';
import type { Comment } from './comment';
import type { Image } from './image';
import type { Like } from './like';
import type { Tag } from './tag';

export type PostStatus = 'draft' | 'published' | 'archived';

export interface Post {
    id: number;
    user_id: number;
    title: string;
    slug: string;
    excerpt: string | null;
    content: string;
    status: PostStatus;
    published_at: string | null;
    reading_time: number | null;
    views: number;
    is_featured: boolean;
    created_at: string;
    updated_at: string;
    user: User;
    tags: Tag[];
    comments: Comment[];
    comments_count: number;
    likes: Like[];
    likes_count: number;
    main_image: Image | null;
    gallery_images: Image[] | null;
}
