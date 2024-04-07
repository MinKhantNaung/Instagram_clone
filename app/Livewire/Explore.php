<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class Explore extends Component
{
    #[On('closeModal')]
    public function removeUrl()
    {
        $this->js("history.replaceState({}, '', '/explore')");
    }

    public function render()
    {
        $posts = Post::limit(20)->get();

        return view('livewire.explore', ['posts' => $posts]);
    }
}
