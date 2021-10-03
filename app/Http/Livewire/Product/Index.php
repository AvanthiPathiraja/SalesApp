<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Product\Create as ProductCreate;


class Index extends ProductCreate
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
        $products = Product::where('is_active',1)
            ->where(DB::raw('concat(category,name,metric,size,unit_price)'),'like','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.product.index')
            ->with(['products' => $products]);
    }

}
