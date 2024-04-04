<?php

namespace App\Livewire\Post;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class Item extends Component
{
    public $post;

    public $body;

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
