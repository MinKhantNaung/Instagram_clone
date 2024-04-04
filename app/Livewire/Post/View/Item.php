<?php

namespace App\Livewire\Post\View;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public $body;
    public $parent_id = null;

    public function addComment()
    {
        $this->validate([
            'body' => 'required'
        ]);

        Comment::create([
            'body' => $this->body,
            'user_id' => auth()->id(),
            'parent_id' => $this->parent_id,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
        ]);

        $this->reset('body', 'parent_id');
    }

    function setParent(Comment $comment)
    {
        $this->parent_id = $comment->id;
        $this->body = '@' . $comment->user->name;
    }

    public function render()
    {
        $comments = $this->post->comments()->whereDoesntHave('parent')->get();

        return view('livewire.post.view.item', compact('comments'));
    }
}
