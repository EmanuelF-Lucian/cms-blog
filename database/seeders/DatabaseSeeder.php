<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Comment as ModelsComment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory()->createMany([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('secret123'),
                'role' => UserRole::ADMIN
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('secret123'),
                'role' => UserRole::USER
            ],
            [
                'name' => 'guest',
                'email' => 'guest@gmail.com',
                'password' => Hash::make('secret123'),
                'role' => UserRole::USER
            ],
        ]);
        $tags = Tag::factory(15)->create();
        $posts = Post::factory(50)->recycle($users)->create();
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(1, min(4, $tags->count()))));
        });

        $comments = ModelsComment::factory(100)->recycle($users)->recycle($posts)->create();
        $comments->each(function ($comment) use ($users) {
            ModelsComment::factory(2)->recycle($users)->reply($comment)->create();
        });
        $posts->each(function ($post) use ($users) {
            $users->random(rand(0, $users->count()))->each(function ($user) use ($post) {
                $post->likes()->create(['user_id' => $user->id]);
            });;
        });

        $posts->each(function ($post) use ($users) {
            // Main image
            $post->images()->create(
                Image::factory()->main()->make(['user_id' => $post->user_id])->toArray()
            );

            // Gallery images
            Image::factory(rand(2, 5))->make(['user_id' => $post->user_id])->each(function ($image) use ($post) {
                $post->images()->create($image->toArray());
            });
        });
    }
}
