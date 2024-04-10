<?php

namespace App\Livewire\Profile;

use App\Models\Conversation;
use App\Models\User;
use App\Notifications\NewFollowerNotification;
use Livewire\Component;
use Livewire\Attributes\On;

class Home extends Component
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

        if (auth()->user()->isFollowing($this->user)) {
            $this->user->notify(new NewFollowerNotification(auth()->user()));
        }
    }

    public function message($userId)
    {
        $authenticatedUserId = auth()->id();

        // check if conversation exists
        $existingConversation = Conversation::where(function ($query) use ($authenticatedUserId, $userId) {
            $query->where('sender_id', $authenticatedUserId)
                ->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($authenticatedUserId, $userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $authenticatedUserId);
        })
        ->first();

        if ($existingConversation) {

            // redirect to conversation
            return redirect()->route('chat.main', $existingConversation->id);
        }

        // create new conversation
        $newConversation = Conversation::create([
            'sender_id' => $authenticatedUserId,
            'receiver_id' => $userId
        ]);

        return redirect()->route('chat.main', $newConversation->id);
    }

    public function render()
    {
        // add this in order to update the withCount() variables on hydrate
        $this->user = User::whereUsername($this->user->username)
            ->withCount(['followers', 'followings', 'posts'])
            ->firstOrFail();

        $posts = $this->user->posts()->where('type', 'post')->get();

        return view('livewire.profile.home', ['posts' => $posts]);
    }
}
