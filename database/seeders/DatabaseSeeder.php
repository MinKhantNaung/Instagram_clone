<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Post::factory(12)->hasComments(rand(12, 30))->create(['type' => 'reel']);
        Post::factory(12)->hasComments(rand(12, 30))->create(['type' => 'post']);

        // create comment replies
        Comment::limit(50)->each(function ($comment) {
            $comment::factory(rand(1, 5))->isReply($comment->commentable)->create(['parent_id' => $comment->id]);
        });
    }
}
