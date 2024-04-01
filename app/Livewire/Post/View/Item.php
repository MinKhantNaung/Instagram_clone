<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public function render()
    {
        return view('livewire.post.view.item');
    }
}
