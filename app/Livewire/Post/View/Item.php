<?php

namespace App\Livewire\Post\View;

use App\Events\CommentEvent;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotification;
use App\Notifications\PostLikedNotification;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public $body;
    public $parent_id = null;

    public function togglePostLike()
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($this->post);

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
            'parent_id' => $this->parent_id,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
        ]);

        // call comments event for live updating comment
        CommentEvent::dispatch();

        $this->js("
            const commentsContainer = document.getElementById('comments-container');
            commentsContainer.scrollTop = 0;
            ");

        $this->reset('body', 'parent_id');

        // notify user
        if ($this->post->user_id != auth()->id()) {

            $this->post->user->notify(new NewCommentNotification(auth()->user(), $comment));
        }
    }

    function setParent(Comment $comment)
    {
        $this->parent_id = $comment->id;
        $this->body = '@' . $comment->user->name;
    }

    public function render()
    {
        $comments = $this->post->comments()->whereDoesntHave('parent')->orderByDesc('id')->get();

        return view('livewire.post.view.item', compact('comments'));
    }
}
