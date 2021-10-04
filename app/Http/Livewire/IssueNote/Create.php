<?php

namespace App\Http\Livewire\IssueNote;

use App\Models\Stock;
use App\Models\Product;
use Livewire\Component;
use App\Models\Employee;
use App\Models\IssueItem;
use App\Models\IssueNote;
use App\View\Components\FlashMsg;

class Create extends Component
{
    public $products = [];
    public $product_id;

    public $stocks = [];
    public $stock_id;

    public $distributors = [];
    public $distributor_id;

    public $issue_note,$issue_note_id,$number,$date,$reference;

    public $issue_items = [];
    public $issue_item,$issue_item_id,$quantity;
    public $unit_price,$expire_date,$available_quantity;

    public function mount()
    {
        $this->products = Product::where('is_active',1)->get();
        $this->distributors = Employee::where('is_active',1)->get();
        $this->date = date('y-m-d');

        if($this->issue_note)
        {
            $this->issue_note = IssueNote::findOrFail($this->issue_note);

            $this->issue_note_id = $this->issue_note->id;
            $this->number = $this->issue_note->number;
            $this->reference = $this->issue_note->reference;
            $this->date = $this->issue_note->date;
            $this->distributor_id = $this->issue_note->distributor_id;

            $selected_issue_items = IssueItem::where('issue_note_id',$this->issue_note_id)->get();

            foreach($selected_issue_items as $issue_item)
            {
                $this->issue_items[] = [
                    'product_id' => $issue_item->product_id,
                    'stock_id' => $issue_item->stock_id,
                    'stock_number' => $issue_item->stock->number,
                    'product_details' => "{$issue_item->product->product_details} {$issue_item->product->unit_details}",
                    'unit_price' => $issue_item->stock->unit_price,
                    'quantity' => $issue_item->quantity,
                    'line_total' => $issue_item->quantity * $issue_item->stock->unit_price,
                ];
            }
        }
    }

    public function updatedProductId()
    {
        $this->reset(['expire_date','available_quantity','unit_price','quantity']);
        if($this->product_id)
        {
            $this->stocks = Stock::where('product_id',$this->product_id)->get();
        }
    }

    public function updatedStockId()
    {
        $this->reset(['expire_date','available_quantity','unit_price','quantity']);
        if($this->stock_id)
        {
            $stock = Stock::find($this->stock_id);
            $this->unit_price = $stock->unit_price;
            $this->expire_date = $stock->expire_date;
            $recieved_quantity = $stock->quantity;
            $issued_quantity = IssueItem::where('stock_id',$stock->id)->sum('quantity');
            $quantity_in_list = collect($this->issue_items)->where('stock_id',$this->stock_id)->sum('quantity');
            $this->available_quantity = $recieved_quantity - ($issued_quantity + $quantity_in_list);
        }
    }

    public function addIssueItemToList()
    {
        $this->validate([
            'product_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);

        $dupplicate_stock_id_count = collect($this->issue_items)->where('stock_id',$this->stock_id)->count('stock_id');

        if($dupplicate_stock_id_count > 0)
        {
            session()->flash('errorIssueItemDupplicate','Already in the list. Please try again !');
        }
        else
        {
            if($this->quantity > $this->available_quantity)
        {
            session()->flash('errorIssueItemQuantity','Invalid quantity. Please try again !');
        }
        else
        {
            $selected_product = collect($this->products)->where('id',$this->product_id)->first();
            $selected_stock = collect($this->stocks)->where('id',$this->stock_id)->first();

            $this->issue_items[] = [
                'product_id' => $this->product_id,
                'stock_id' => $this->stock_id,
                'stock_number' => $selected_stock->number,
                'product_details' => $selected_product->product_details,
                'unit_price' => $this->unit_price,
                'quantity' => $this->quantity,
                'line_total' => $this->quantity * $this->unit_price,
            ];

            $this->reset(['product_id','stock_id','expire_date','available_quantity','unit_price','quantity']);
            session()->flash('successIssueItem','Completed Successfully !');
        }
        }
    }

    public function removeIssueItemFromList($key)
    {
        unset($this->issue_items[$key]);
        $this->reset(['product_id','stock_id','expire_date','available_quantity','unit_price','quantity']);

    }

    public function saveOrUpdateIssueNote()
    {
        $validated_data = $this->validate([
            'number' => 'required|max:20',
            'reference' => 'nullable|max:20',
            'date' => 'required|date',
            'distributor_id' => 'required|numeric',

        ]);

        if(collect($this->issue_items)->count() > 0)
        {
            $this->issue_note = IssueNote::updateOrCreate($validated_data);
            $this->issue_note->issue_items()->delete();
            $this->issue_note->issue_items()->createMany($this->issue_items);

            session()->flash('successIssueNote','Completed Successfully !');
        }
        else
        {
            session()->flash('errorIssueNote','No items in the list. Please try again !');
        }
    }

    public function deleteIssueNote(IssueNote $issue_note)
    {
        $issue_note->delete();
        return redirect()->route('issue-note.index');
    }

    public function render()
    {
        return view('livewire.issue-note.create');
    }
}
