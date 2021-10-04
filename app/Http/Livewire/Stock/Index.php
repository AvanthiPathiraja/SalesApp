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

    protected $listeners = ['search'];
    public $search;

    public function search($val)
    {
        $this->search = $val;
    }

    public function render()
    {

        $stocks = Stock::where(function($stock){
            $stock
                ->whereDate('date','like','%'.$this->search.'%')
                ->orWhere('number','like','%'.$this->search.'%')
                ->orWhere('quantity','like','%'.$this->search.'%')
                ->orWhere('unit_price','like','%'.$this->search.'%')
                ->orWhereDate('expire_date','like','%'.$this->search.'%');
        })
        ->orWhere(function($product){
            $product
            ->whereHas('product',function($product1){
                $product1
                    ->where('category','like','%'.$this->search.'%')
                    ->orWhere('name','like','%'.$this->search.'%');

            });
        })

        ->paginate(10);

        return view('livewire.stock.index')
            ->with(['stocks' => $stocks]);
    }



}
