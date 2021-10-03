<?php

namespace App\Http\Livewire\DiscardedStock;

use App\Models\DiscardedStock;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search;
    protected $listners = ['search'];

    public function search($val)
    {
        $this->search = '%'.$val.'%';
    }

    public function render()
    {
        $discarded_stocks = DiscardedStock::paginate(10);

        return view('livewire.discarded-stock.index')
            ->with(['discarded_stocks' => $discarded_stocks]);
    }
}
