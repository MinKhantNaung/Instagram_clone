<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $post;

    // can copy from ModalComponent
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    // can copy from ModalComponent
    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function mount()
    {
        $this->post = Post::findOrFail($this->post);

        // get url
        $url = url('post/' . $this->post->id);

        // push state using new livewire v3 js helper
        $this->js("history.pushState({}, '', '{$url}')");
    }

    public function render()
    {
        return <<<'BLADE'
        <main class="bg-white h-[calc(100vh-3.5rem)] md:h-[calc(100vh-5rem)] flex flex-col border gap-y-4 px-5">

            <header class="w-full py-2">
                <div class="flex justify-end">
                    <button wire:click="$dispatch('closeModal')" type="button" class="xl font-bold">X</button>
                </div>
            </header>

        </main>
        BLADE;
    }
}
