<?php

namespace App\Http\Livewire\DiscardedStock;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DiscardedStock;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $search;
    protected $listeners = ['search'];

    public function search($val)
    {
        $this->search = $val;
    }

    public function render()
    {
        $discarded_stocks = DiscardedStock::where(DB::raw('concat(date)'),'like','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.discarded-stock.index')
            ->with(['discarded_stocks' => $discarded_stocks]);
    }
}
