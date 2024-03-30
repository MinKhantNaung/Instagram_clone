<?php

namespace App\Livewire\Post;

use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public function render()
    {
        return view('livewire.post.create');
    }
}
