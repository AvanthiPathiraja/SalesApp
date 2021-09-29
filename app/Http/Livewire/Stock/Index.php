<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use Livewire\Component;
use App\Http\Livewire\Stock\Create as StockCreate;


class Index extends StockCreate
{
    public $stocks=[];


    public function mount()
    {
        $this->stocks = Stock::all();
    }

    public function render()
    {

        return view('livewire.stock.index');
    }



}
