<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Stock\Create as StockCreate;

class Index extends StockCreate
{
   use WithPagination;

   public $search;
   protected $listners = ['search'];

    public function search($val)
    {
        dd(123);
        $this->search = $val;
    }

    public function render()
    {

        $stocks = Stock::where(DB::raw('concat(number,date)'),'like','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.stock.index')
            ->with(['stocks' => $stocks]);
    }



}
