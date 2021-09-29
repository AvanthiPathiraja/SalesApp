<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Product\Create as ProductCreate;


class Index extends ProductCreate
{
    public $products = [];

    public function render()
    {
        return view('livewire.product.index');
    }

    public function mount()
    {
        $this->products = Product::where('is_active',1)->get();
    }
}
