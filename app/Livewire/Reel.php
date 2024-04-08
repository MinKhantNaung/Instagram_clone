<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class Reel extends Component
{
    #[On('closeModal')]
    public function removeUrl()
    {
        $this->js("history.replaceState({}, '', '/reels')");
    }

    public function togglePostLike(Post $post)
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleLike($post);
    }

    public function togglePostFavorite(Post $post)
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFavorite($post);
    }

    public function render()
    {
        $posts = Post::limit(20)->where('type', 'reel')->get();

        return view('livewire.reel', ['posts' => $posts]);
    }
}
