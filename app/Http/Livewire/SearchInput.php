<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchInput extends Component
{
    public $search;

    public function updated()
    {
        $this->emit('search', $this->search);
    }

    public function render()
    {
        return view('livewire.search-input');
    }
}
