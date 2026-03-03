<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Featured Post
        $featuredPost = Post::query()
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->with([
                'user:id,name',
                'mainImage:id,imageable_id,imageable_type,path,role',
            ])
            ->first();

        // 2. Sidebar Posts (ex. 5 cele mai populare)
        $sidebarPosts = Post::query()
            ->whereNotNull('published_at')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->with([
                'mainImage:id,imageable_id,imageable_type,path,role',
            ])
            ->get(['id', 'title', 'slug', 'views', 'published_at']);

        // 3. Recent Posts (ex. ultimele 6)
        $recentPosts = Post::query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->with([
                'mainImage:id,imageable_id,imageable_type,path,role',
                'user:id,name',
                'tags:id,name,slug',
            ])
            ->get([
                'id',
                'user_id',
                'title',
                'slug',
                'excerpt',
                'published_at',
                'reading_time',
            ]);

        return Inertia::render('Home', [
            'canRegister' => Features::enabled(Features::registration()),
            'featuredPost' => $featuredPost,
            'sidebarPosts' => $sidebarPosts,
            'recentPosts' => $recentPosts,
        ]);
    }
}
