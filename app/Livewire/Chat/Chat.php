<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Livewire\Component;

class Chat extends Component
{
    public Conversation $conversation;
    public $receiver;

    public function mount()
    {
        $this->receiver = $this->conversation->getReceiver();
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
