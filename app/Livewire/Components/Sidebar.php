<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $shrink = false;
    public $drawer = false;

    public $query;
    public $results;

    public function updatedQuery($query)
    {
        if ($query == '') {
            return $this->results = null;
        } else {
            $this->results = User::where('username', 'LIKE', '%' . $query . '%')
                ->orWhere('name', 'LIKE', '%' . $query . '%')
                ->get();

            return $this->results;
        }

    }

    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
