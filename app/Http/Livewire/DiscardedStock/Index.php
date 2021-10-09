<?php

namespace App\Http\Livewire\DiscardedStock;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DiscardedStock;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\DiscardedStock\Create as DiscardedStockCreate;

class Index extends DiscardedStockCreate
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
        $discarded_stocks = DiscardedStock::where(function($discarded_stock){
            $discarded_stock
            ->where('date','like','%'.$this->search.'%')
            ->orWhere('quantity','like','%'.$this->search.'%')
            ->orWhere('reason','like','%'.$this->search.'%');
        })
        ->orWhereHas('employee',function($employee){
            $employee
            ->where(DB::raw('concat(title," ",first_name," ",last_name)'),'like','%'.$this->search.'%');
        })
        ->orWhereHas('stock',function($stock){
            $stock
            ->where('number','like','%'.$this->search.'%')
            ->orWhereHas('product',function($product){
                $product
                ->where('category','like','%'.$this->search.'%')
                ->orWhere('name','like','%'.$this->search.'%');
            });
        })
        ->paginate(10);

        return view('livewire.discarded-stock.index')
            ->with(['discarded_stocks' => $discarded_stocks]);
    }
}
