<?php

namespace App\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Saved extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = User::whereUsername($user)
            ->withCount(['followers', 'followings', 'posts'])
            ->firstOrFail();
    }

    #[On('closeModal')]
    public function removeUrl()
    {
        $this->js("history.replaceState({}, '', '/')");
    }

    public function toggleFollow()
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFollow($this->user);
    }

    public function render()
    {
        // add this in order to update the withCount() variables on hydrate
        $this->user = User::whereUsername($this->user->username)
            ->withCount(['followers', 'followings', 'posts'])
            ->firstOrFail();

        $posts = $this->user->getFavoriteItems(Post::class)->get();

        return view('livewire.profile.saved', ['posts' => $posts]);
    }
}
