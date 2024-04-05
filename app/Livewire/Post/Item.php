<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public $body;

    public function togglePostLike()
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($this->post);
    }

    public function toggleCommentLike(Comment $comment)
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($comment);
    }

    public function togglePostFavorite()
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFavorite($this->post);
    }

    public function addComment()
    {
        $this->validate([
            'body' => 'required'
        ]);

        Comment::create([
            'body' => $this->body,
            'user_id' => auth()->id(),
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
        ]);

        $this->reset('body');
    }

    public function render()
    {
        return view('livewire.post.item');
    }
}
