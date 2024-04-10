<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public Conversation $conversation;
    public $receiver;

    public $body;

    public function sendMessage()
    {
        $this->validate([
            'body' => 'required|string'
        ]);

        $createdMessage = Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiver->id,
            'body' => $this->body
        ]);

        $this->reset('body');
    }

    public function mount()
    {
        $this->receiver = $this->conversation->getReceiver();
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
