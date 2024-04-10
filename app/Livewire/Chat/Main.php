<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Livewire\Component;

class Main extends Component
{
    public $chat;
    public $conversation;

    public function mount()
    {
        $this->conversation = Conversation::findOrFail($this->chat);
    }

    public function render()
    {
        return <<<'HTML'
                <div class="w-full h-[calc(100vh-0.0rem)] flex bg-white rounded-lg" >

                    <div class="hidden lg:flex relative w-full h-full md:w-[320px] xl:w-[400px] border-r shrink-0 overflow-y-auto">

                        <livewire:chat.chat-list>

                    </div>

                    <main class="grid w-full h-full relative overflow-y-auto" style="contain: content">

                        <livewire:chat.chat :conversation="$this->conversation" />

                    </main>

                </div>
        HTML;
    }
}
