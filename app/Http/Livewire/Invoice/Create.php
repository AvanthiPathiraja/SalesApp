<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\IssueItem;
use App\Models\InvoiceItem;
use App\Models\DistributorStock;
use App\Models\InvoiceReturn;
use App\Models\IssueNote;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $customers = [];
    public $customer_id;
    public $distributors = [];
    public $distributor_id;

    public $issue_item_stock = [];
    public $issue_item_id;
    public $invoice_return_stock = [];
    public $invoice_return_id;
    public $distributor_cusrrent_stock = [];
    public $stock,$stock_id;
    public $quantity_available_for_sale;

    public $invoice, $invoice_id, $number,$reference, $date, $total_price,$total_discount;

    public $invoice_items = [];
    public $invoice_item_id,$unit_price,$unit_discount,$quantity,$is_free;


    public function mount()
    {
        $this->customers = Customer::where('is_active',1)->get();
        $this->distributors = Employee::where('is_active',1)->get();
        $this->date = date('y-m-d');

        if ($this->invoice)
        {
            $this->invoice = Invoice::findOrFail($this->invoice);

            $this->invoice_id = $this->invoice->id;
            $this->number = $this->invoice->number;
            $this->reference = $this->invoice->reference;
            $this->date = $this->invoice->date;
            $this->customer_id = $this->invoice->customer_id;
            $this->distributor_id = $this->invoice->distributor_id;
            $this->total_price = $this->invoice->total_price;
            $this->total_discount = $this->invoice->total_discount;

            $this->updatedDistributorId();

            $selected_invoice_items = InvoiceItem::where('invoice_id', $this->invoice_id)->get();

            foreach($selected_invoice_items as $invoice_item)
            {
                $this->invoice_items[] = [
                    'stock_id' => $invoice_item->stock_id,
                    'product_details' => "{$invoice_item->stock->number} - {$invoice_item->stock->product->product_details}",
                    'unit_price' => $invoice_item->unit_price,
                    'unit_discount' => $invoice_item->unit_discount,
                    'quantity' =>   $invoice_item->quantity,
                    'is_free' => $invoice_item->is_free,
                    'discount_total' =>   ($invoice_item->quantity * $invoice_item->unit_discount),
                    'line_total' =>   ($invoice_item->quantity * ($invoice_item->unit_price - $invoice_item->unit_discount))
                ];
            }
            $this->total_price = collect($this->invoice_items)->sum('line_total');
            $this->total_discount = collect($this->invoice_items)->sum('discount_total');
       }
    }

    public function updatedDistributorId()
    {
        if($this->distributor_id)
        {
            $this->distributor_cusrrent_stock = IssueItem::whereHas('issue_note',function($issue_note){
                    $issue_note
                    ->where('distributor_id',$this->distributor_id);
                })
            // ->where(function($issue_item){
            //     $issue_item
            //     ->where('is_cleared',0);
            // })
            ->get();

            // $this->distributor_cusrrent_stock = InvoiceReturn::whereHas('invoice',function($invoice){
            //         $invoice
            //         ->where('distributor_id',$this->distributor_id);
            //     })
            // ->where(function($invoice_return){
            //     $invoice_return
            //     ->where('is_cleared',0)
            //     ->where('is_reusable',1);
            // })
            //  ->union($this->issue_item_stock)
            // ->get();
        }

    }

    public function updatedStockId($id)
    {
        if($this->issue_item_id)
        {
            $this->stock = collect($this->distributor_cusrrent_stock)->where('id',$id)->first();
            $issued_quantity = $this->stock->quantity;
            $invoiced_quantity = InvoiceItem::where('stock_id',$this->stock_id)->sum('quantity');

            $this->quantity_available_for_sale = $issue_item_quantity - $invoiced_item_quantity;
            $this->unit_price = $this->issue_item->stock->unit_price;
        }
    }

    public function addInvoiceItemToList()
    {
        $this->validate([
            'issue_item_id' => 'required|numeric',
            'unit_price' => 'required|numeric|min:1',
            'unit_discount' => 'nullable|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);

        //dd($this->issue_item);

        $this->invoice_items[] = [
            'issue_item_id' => $this->issue_item->id,
            'product_details' => $this->issue_item->product->product_details,
            'unit_details' => $this->issue_item->product->unit_details,
            'unit_price' => $this->unit_price,
            'unit_discount' => $this->unit_discount,
            'quantity' =>   $this->quantity,
            'display_is_free' =>   $this->is_free ? 'Yes' : 'No',
            'is_free' =>   $this->is_free,
            'discount_total' =>   ($this->quantity * $this->unit_discount),
            'line_total' =>   ($this->quantity * ($this->unit_price - $this->unit_discount))
        ];

        $this->total_price = collect($this->invoice_items)->sum('line_total');
        $this->total_discount = collect($this->invoice_items)->sum('discount_total');

        session()->flash('successInvoiceItem','Completed Successfully !');
        $this->reset(['issue_item_id','unit_price','unit_discount','quantity']);
    }

    public function removeInvoiceItemFromList($key)
    {
        unset($this->invoice_items[$key]);
    }

    public function saveOrUpdateInvoice()
    {
        $validated_data = $this->validate([
            'number' => 'required|max:20',
            'reference' => 'nullable|max:15',
            'date' => 'required|date',
            'customer_id' => 'required|numeric',
            'distributor_id' => 'required|numeric',
            'total_price' => 'required|numeric|min:1',
            'total_discount' => 'nullable|numeric',
        ]);

        if(collect($this->invoice_items)->count() > 0)
        {
            $this->invoice = Invoice::updateOrCreate($validated_data);
            $this->invoice->items()->delete();
            $this->invoice->items()->createMany($this->invoice_items);

            session()->flash('successInvoice','Completed Successfully !');
        }
        else
        {
            session()->flash('errorInvoice','No invoice items found. Please try again !');
        }
    }

    public function deleteInvoice(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoice.index');
    }

    public function render()
    {
        return view('livewire.invoice.create');
    }
}
