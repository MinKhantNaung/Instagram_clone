<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Home extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
