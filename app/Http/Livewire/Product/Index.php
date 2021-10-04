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

    public $categories = [];
    public $category;

    public function search($val)
    {
        $this->search = $val;
    }

    public function mount()
    {
        $this->categories = Product::select('category as name')
            ->groupBy('category')
            ->get();
    }

    public function render()
    {
        $products = '';
        if($this->category)
        {
            $products = Product::where('is_active',1)
            ->where('category',$this->category)
            ->where(function($product){
                $product
                    ->where('number','like','%'.$this->search.'%')
                    ->orWhere('name','like','%'.$this->search.'%')
                    ->orWhere('metric','like','%'.$this->search.'%')
                    ->orWhere('size','like','%'.$this->search.'%')
                    ->orWhere('unit_price','like','%'.$this->search.'%');
            })
            ->paginate(10);
        }
        else
        {
            $products = Product::where('is_active',1)
            ->where(function($product){
                $product
                    ->where('number','like','%'.$this->search.'%')
                    ->orWhere('name','like','%'.$this->search.'%')
                    ->orWhere('metric','like','%'.$this->search.'%')
                    ->orWhere('size','like','%'.$this->search.'%')
                    ->orWhere('unit_price','like','%'.$this->search.'%');
            })
            ->paginate(10);
        }

        return view('livewire.product.index')
            ->with(['products' => $products]);
    }

}
