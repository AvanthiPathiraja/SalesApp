<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $product;
    public $product_id;
    public $number,$brand_id,$category,$name,$metric,$size,$minimum_stock,$unit_price,$note;


    public function mount()
    {
        if($this->product)
        {
            $this->product = Product::findOrFail($this->product);

            $this->product_id = $this->product->id;
            $this->number = $this->product->number;
            $this->brand_id = $this->product->brand_id;
            $this->category = $this->product->category;
            $this->name = $this->product->name;
            $this->metric = $this->product->metric;
            $this->size = $this->product->size;
            $this->minimum_stock = $this->product->minimum_stock;
            $this->unit_price = $this->product->unit_price;
            $this->note = $this->product->note;
        }
    }

    public function saveOrUpdateProduct()
    {
        $validated_data=$this->validate([
            'number' => 'required|max:20',
            'brand_id' => 'nullable',
            'category' => 'required|max:70',
            'name' => 'required|max:100',
            'metric' => 'nullable|max:70',
            'size' => 'nullable|numeric',
            'minimum_stock' => 'nullable|numeric',
            'unit_price' => 'required|numeric',
            'note' => 'nullable|max:150'
        ]);

        Product::updateOrCreate(['id'=>$this->product_id ?? null],$validated_data);
        session()->flash('success','Successfully inserted !');
        $this->resetProduct();
    }

    public function resetProduct()
    {
        $this->reset(['product','product_id','number','brand_id','category','name','metric','size','minimum_stock','unit_price']);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
