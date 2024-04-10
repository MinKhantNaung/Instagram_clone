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

    public $loadedMessages;
    public $paginate_var = 10;

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

    public function loadMessages()
    {
        // get count
        $count = Message::where('conversation_id', $this->conversation->id)->count();

        // skip and query
        $this->loadedMessages = Message::where('conversation_id', $this->conversation->id)
            ->skip($count - $this->paginate_var)
            ->take($this->paginate_var)
            ->get();

        return $this->loadedMessages;
    }

    public function mount()
    {
        $this->receiver = $this->conversation->getReceiver();

        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
