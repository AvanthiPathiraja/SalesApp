<?php

namespace App\Http\Livewire\InvoiceReturn;

use App\Models\Invoice;
use Livewire\Component;
use App\Models\Employee;
use App\Models\InvoiceItem;
use App\Models\InvoiceReturn;

class Create extends Component
{
    public $distributors = [];
    public $distributor_id;

    public $invoice_items = [];
    public $invoice_item,$invoice_item_id,$invoice_quantity,$stock_id;

    public $invoice,$invoice_id,$invoice_number,$invoice_reference,$invoice_date,$invoice_customer;
    public $date,$reason,$quantity,$is_reusable;

    public function mount()
    {
        $this->distributors = Employee::where('is_active',1)->get();
        $this->date = date('Y-m-d');
    }

    public function updatedInvoiceNumber()
    {
        $this->resetInvoice();
        $this->resetInvoiceReturn();

    }

    public function loadInvoice()
    {
        $this->invoice = Invoice::where('number',$this->invoice_number)
            ->where('is_active',1)
            ->first();

        if($this->invoice)
        {
            $this->invoice_id = $this->invoice->id;
            $this->invoice_reference = $this->invoice->reference;
            $this->invoice_date = $this->invoice->date;
            $this->invoice_customer = $this->invoice->customer->name;

            $this->invoice_items = InvoiceItem::where('invoice_id',$this->invoice_id)
                ->where('is_free',0)
                ->get();
        }
        else
        {
            session()->flash('invalidInvoice','Invalid Invoice Number !');
        }
    }

    public function updatedInvoiceItemId()
    {
        $this->resetInvoiceReturn();
        if($this->invoice_item_id)
        {
            $invoice_item = collect($this->invoice_items)->where('id',$this->invoice_item_id)->first();
            $this->invoice_quantity = $invoice_item['quantity'];
            $this->stock_id = $invoice_item['stock_id'];

        }
    }

    public function saveInvoiceReturn()
    {
        $validated_data = $this->validate([
            'date' => 'required|date',
            'invoice_id' => 'required|numeric',
            'invoice_item_id' =>'required|numeric',
            'stock_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'reason' => 'required',
            'distributor_id' => 'required|numeric'
        ]);

        $dupplicate_returns = InvoiceReturn::where('stock_id',$this->stock_id)
        ->where('invoice_id',$this->invoice_id)
        ->count();

        if($dupplicate_returns > 0)
        {
            session()->flash('dupplicateStockId','The invoice item has already returned.');
        }
        else
        {
            if($this->invoice_quantity < $this->quantity )
            {
                session()->flash('invalidQuantity','Invalid quantity ! please try again.');
            }
            else
            {
                InvoiceReturn::create($validated_data);
                session()->flash('success','Completed Successfully !');
                $this->resetInvoice();
                $this->resetInvoiceReturn();
                $this->reset(['invoice_number']);
            }
        }
    }

    public function resetInvoice()
    {
        $this->reset(['invoice_reference','invoice_date','invoice_customer','invoice_id','invoice_items']);
    }

    public function resetInvoiceReturn()
    {
        $this->reset(['stock_id','invoice_quantity','quantity','reason','distributor_id','is_reusable']);
        $this->date = date('Y-m-d');
    }

    public function deleteInvoiceReturn(InvoiceReturn $invoice_return)
    {
        $invoice_return->delete();
        return redirect()->route('invoice-return.index');
    }

    public function render()
    {
        return view('livewire.invoice-return.create');
    }
}
