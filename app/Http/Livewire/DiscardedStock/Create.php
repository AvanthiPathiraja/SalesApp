<?php

namespace App\Http\Livewire\DiscardedStock;

use App\Models\DiscardedStock;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Employee;

class Create extends Component
{

    public $employees = [];
    public $employee_id;

    public $stocks = [];
    public $stock_id,$current_stock;

    public $date,$quantity,$reason,$note;

    public function mount()
    {
        $this->employees = Employee::where('is_active',1)->get();
        $this->stocks = Stock::all();
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

        DiscardedStock::create($validated_data);
        session()->flash('success','Completed Successfully !');
    }

    public function deleeDiscardedStock(DiscardedStock $discarded_stock)
    {
        $discarded_stock->delete();
        return redirect()->route('discarded-stock.index');
    }

    public function render()
    {
        return view('livewire.discarded-stock.create');
    }
}
