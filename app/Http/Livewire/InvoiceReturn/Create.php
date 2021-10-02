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
    public $invoice_item,$invoice_item_id,$invoice_item_quantity,$stock_id;

    public $invoice,$invoice_id,$invoice_number,$invoice_reference,$invoice_date,$invoice_customer;
    public $date,$reason,$quantity,$is_reusable;

    public function mount()
    {
        $this->distributors = Employee::where('is_active',1)->get();
    }

    public function saveOrUpdateInvoiceReturn()
    {
        $validated_data = $this->validate([
            'date' => 'required|date',
            'invoice_id' => 'required|numeric',
            'invoice_item_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'reason' => 'required',
            'distributor_id' => 'required|numeric'
        ]);

        InvoiceReturn::updateOrCreate($validated_data);
        session()->flash('success','Completed Successfully !');
    }

    public function updatedInvoiceNumber()
    {
        $this->reset('invoice_reference','invoice_date','invoice_customer','invoice_id','invoice_items');
    }

    public function loadInvoice()
    {
        $this->invoice = Invoice::where([
            ['number',$this->invoice_number],
            ['is_active',1],
        ])->first();

        if($this->invoice)
        {
            $this->invoice_id = $this->invoice->id;
            $this->invoice_reference = $this->invoice->reference;
            $this->invoice_date = $this->invoice->date;
            $this->invoice_customer = $this->invoice->customer->name;

            $this->invoice_items = InvoiceItem::where('invoice_id',$this->invoice_id)->get();
        }
        else
        {
            session()->flash('invalidInvoice','Invalid Invoice Number !');
        }
    }

    public function updatedInvoiceItemId()
    {
        $this->reset('invoice_item_quantity','stock_id');
        if($this->invoice_item_id)
        {
            $invoice_item_return_count = InvoiceReturn::where('invoice_item_id',$this->invoice_item_id)->count();
            if($invoice_item_return_count > 0)
            {
                session()->flash('errorInvoiceItem','The invoice item has already returned.');
            }
            else
            {
                $invoice_item = collect($this->invoice_items)->where('id',$this->invoice_item_id)->first();
                $this->invoice_item_quantity = $invoice_item['quantity'];
                $this->stock_id = $invoice_item['stock_id'];
            }
        }
    }

    public function render()
    {
        return view('livewire.invoice-return.create');
    }
}
