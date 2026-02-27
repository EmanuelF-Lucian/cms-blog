<?php

use App\Enums\PostStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->string('status')->default(PostStatus::DRAFT->value);
            $table->dateTime('published_at')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->unsignedInteger('reading_time')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->json('meta')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['id', 'published_at']);
            $table->index('slug');
            $table->index(['status', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
