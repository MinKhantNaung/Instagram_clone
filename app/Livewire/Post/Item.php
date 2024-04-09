<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use App\Notifications\PostLikedNotification;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public $body;

    public function togglePostLike()
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($this->post);

        // notify post's user if like
        if ($this->post->isLikedBy(auth()->user())) {
            if ($this->post->user_id != auth()->id()) {

                $this->post->user->notify(new PostLikedNotification(auth()->user(), $this->post));
            }
        }
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

        $comment = Comment::create([
            'body' => $this->body,
            'user_id' => auth()->id(),
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
        ]);

        $this->reset('body');

        // notify user
        if ($this->post->user_id != auth()->id()) {

            $this->post->user->notify(new NewCommentNotification(auth()->user(), $comment));
        }
    }

    public function render()
    {
        return view('livewire.post.item');
    }
}
