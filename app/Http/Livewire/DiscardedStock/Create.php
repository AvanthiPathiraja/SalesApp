<?php

namespace App\Http\Livewire\DiscardedStock;

use App\Models\Stock;
use Livewire\Component;
use App\Models\Employee;
use App\Models\DiscardedStock;
use Illuminate\Support\Facades\DB;

class Create extends Component
{

    public $employees = [];
    public $employee_id;

    public $stocks = [];
    public $stock_id,$current_stock_quantity;

    public $date,$quantity,$reason,$note;

    public function mount()
    {
        $this->employees = Employee::where('is_active',1)->get();
        $this->resetDiscardedStock();
    }

    public function updatedStockId()
    {
        $stock = collect($this->stocks)
            ->where('id',$this->stock_id)
            ->first();
        $this->current_stock_quantity = ($stock->quantity + $stock->returned_quantity)
        - ($stock->issued_quantity + $stock->invoiced_quantity + $stock->discarded_quantity);
    }

    public function saveDiscardedStock()
    {
        $validated_data = $this->validate([
            'date' => 'required|date',
            'employee_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'reason' => 'required',
            'note' => 'nullable',
        ]);

        if($this->current_stock_quantity < $this->quantity)
        {
            session()->flash('invalidQuantity','Invalid quantity. Please try again.');
        }
        else
        {
            DiscardedStock::create($validated_data);
            Stock::where('id',$this->stock_id)
                ->update([
                    'discarded_quantity' => DB::raw('discarded_quantity +'.$this->quantity)
                ]);
            session()->flash('success','Completed Successfully !');
        }
    }

    public function resetDiscardedStock()
    {
        $this->reset(['stocks','stock_id','current_stock_quantity','quantity','reason','employee_id','note']);
        $this->date = date('Y-m-d');
        $this->stocks = Stock::where( DB::raw('((quantity + returned_quantity) - (issued_quantity + invoiced_quantity + discarded_quantity))'),'>',0)
            ->get();
    }

    public function deleteDiscardedStock(DiscardedStock $discarded_stock)
    {
        $discarded_stock->delete();
        return redirect()->route('discarded-stock.index');
    }

    public function render()
    {
        return view('livewire.discarded-stock.create');
    }
}
