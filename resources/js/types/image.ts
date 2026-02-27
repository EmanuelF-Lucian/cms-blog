export interface Image {
    id: number;
    user_id: number | null;
    imageable_id: number;
    imageable_type: string;
    path: string;
    disk: string;
    mime_type: string | null;
    size: number | null;
    width: number | null;
    height: number | null;
    created_at: string;
    updated_at: string;
}
