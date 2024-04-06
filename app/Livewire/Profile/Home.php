<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = User::whereUsername($user)
            ->withCount(['followers', 'followings', 'posts'])
            ->firstOrFail();
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

        return view('livewire.profile.home');
    }
}
