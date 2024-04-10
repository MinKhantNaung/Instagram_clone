<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ChatList extends Component
{
    public function render()
    {
        $conversations = auth()->user()->conversations()->get();

        return view('livewire.chat.chat-list', [
            'conversations' => $conversations
        ]);
    }
}
