<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use App\Notifications\NewFollowerNotification;

class Notifications extends Component
{
    public function toggleFollow(User $user)
    {
        abort_unless(auth()->check(), 401);

        auth()->user()->toggleFollow($user);

        if (auth()->user()->isFollowing($user)) {
            $user->notify(new NewFollowerNotification(auth()->user()));
        }
    }

    public function render()
    {
        return view('livewire.components.notifications', [
            'notifications' => auth()->user()->notifications
        ]);
    }
}
