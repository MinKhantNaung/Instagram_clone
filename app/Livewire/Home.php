<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $posts;

    #[On('post-created')]
    public function postCreated($id)
    {
        $post = Post::find($id);

        $this->posts = $this->posts->prepend($post);
    }

    public function mount()
    {
        $this->posts = Post::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
