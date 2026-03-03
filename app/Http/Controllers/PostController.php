<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->with([
                'user',
                'mainImage:id,imageable_id,imageable_type,path,role',
            ])->paginate(9);

        return Inertia::render('posts/Index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $tags = $post->tags()->get();
        $post->load([
            'user',
            'comments' => function ($query) {
                $query->with([
                    'user',
                    'replies.user',   // dacă vrei și user pe replies
                ])
                    ->withCount([
                        'likes',   // likes_count
                        'replies', // replies_count
                    ]);
            },
            'mainImage:id,imageable_id,imageable_type,path,role',
            'galleryImages:id,imageable_id,imageable_type,path,role',
        ])->loadCount(['likes', 'comments']);



        return Inertia::render('posts/Show', ['post' => $post, 'tags' => $tags]);
    }
}
