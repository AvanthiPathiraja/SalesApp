<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $products=[];
    public $selected_product;
    public $product_id;

    public $stock;
    public $stock_id;
    public $number,$date,$quantity,$expire_date,$unit_price,$unit_cost;


    public function mount()
    {
        $this->products = Product::where('is_active',1)->get();

        if($this->stock)
        {
            $this->stock = Stock::findOrFail($this->stock);

            $this->stock_id = $this->stock->id;
            $this->product_id = $this->stock->product_id;
            $this->number = $this->stock->number;
            $this->date = $this->stock->date;
            $this->quantity = $this->stock->quantity;
            $this->expire_date = $this->stock->expire_date;
            $this->unit_price = $this->stock->unit_price;
            $this->unit_cost = $this->stock->unit_cost;

        }
    }

    public function updatedProductId()
    {
        $this->selected_product = collect($this->products)->where('id',$this->product_id)->first();
        $this->unit_price = $this->selected_product->unit_price;
    }

    public function saveOrUpdateStock()
    {
        $validated_data=$this->validate([
            'number' => 'required|max:20',
            'date' => 'required|date',
            'product_id' => 'required|numeric',
            'unit_price' => 'required|numeric|min:1',
            'unit_cost' => 'nullable|numeric',
            'quantity' => 'required|numeric',
            'expire_date' => 'nullable|date',
        ]);

        Stock::updateOrCreate(['id'=>$this->stock_id ?? null],$validated_data);
        session()->flash('success','Successfully inserted !');
        return redirect()->route('stock.index');

    }

    public function deleteStock(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stock.index');
    }

    public function form_reset()
    {
        $this->reset(['number','date','product_id','unit_price','unit_cost','quantity','expire_date']);
    }

    public function render()
    {
        return view('livewire.stock.create');
    }

}
