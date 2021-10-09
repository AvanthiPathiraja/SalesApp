<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Stock;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\IssueItem;
use App\Models\InvoiceItem;
use App\Models\InvoiceReturn;

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
    public $stock,$stock_id,$quantity_available;

    public $invoice, $invoice_id, $number,$reference, $date, $total_price,$total_discount;

    public $invoice_items = [];
    public $invoice_item_id,$unit_price,$unit_discount,$quantity,$is_free;


    public function mount()
    {
        $this->customers = Customer::where('is_active',1)->get();
        $this->distributors = Employee::where('is_active',1)->get();
        $this->date = date('Y-m-d');

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

            $selected_invoice_items = InvoiceItem::where('invoice_id', $this->invoice_id)->get();

            foreach($selected_invoice_items as $invoice_item)
            {
                $this->invoice_items[] = [
                    'stock_id' => $invoice_item->stock_id,
                    'stock_number' => $invoice_item->stock->number,
                    'product_details' => $invoice_item->stock->product->product_details,
                    'unit_price' => $invoice_item->unit_price,
                    'unit_discount' => $invoice_item->unit_discount,
                    'quantity' =>   $invoice_item->quantity,
                    'is_free' => $invoice_item->is_free,
                    'discount_total' =>   ($invoice_item->quantity * $invoice_item->unit_discount),
                    'line_total' =>   ($invoice_item->quantity * ($invoice_item->unit_price - $invoice_item->unit_discount))
                ];
            }
            $this->invoiceItemsSummery();
        }
    }

    public function updatedDistributorId()
    {
        if($this->distributor_id)
        {
            $this->resetDistributorStock();

            $stock_issue_items = IssueItem::where(function($issue_item){
                    $issue_item ->where('is_cleared',0);
                })
                ->whereHas('issue_note',function($issue_note){
                    $issue_note  ->where('distributor_id',$this->distributor_id);
                })
                ->get();

            $stock_invoice_returns = InvoiceReturn::where(function($invoice_return){
                    $invoice_return
                    ->where('is_cleared',0)
                    ->where('is_reusable',1)
                    ->where('distributor_id',$this->distributor_id);
                })
                ->get();

            $stock_invoice_items = InvoiceItem::where(function($invoice_item){
                    $invoice_item ->where('is_cleared',0);
                })
                ->whereHas('invoice',function($invoice){
                    $invoice ->where('distributor_id',$this->distributor_id);
                })
                ->get();

            foreach($stock_issue_items as $stock)
            {
                $this->distributor_cusrrent_stock[] = [
                    'stock_id' => $stock->stock_id,
                    'stock_number' => $stock->stock->number,
                    'product_details' => $stock->stock->product->product_details,
                    'quantity' => $stock->quantity,
                ];
            }
            foreach($stock_invoice_returns as $stock)
            {
                $this->distributor_cusrrent_stock[] = [
                    'stock_id' => $stock->stock_id,
                    'stock_number' => $stock->stock->number,
                    'product_details' => $stock->stock->product->product_details,
                    'quantity' => $stock->quantity,
                ];
            }
            foreach($stock_invoice_items as $stock)
            {
                $this->distributor_cusrrent_stock[] = [
                    'stock_id' => $stock->stock_id,
                    'stock_number' => $stock->stock->number,
                    'product_details' => $stock->stock->product->product_details,
                    'quantity' => '-'.$stock->quantity,
                ];
            }

            //$this->distributor_cusrrent_stock = collect($this->distributor_cusrrent_stock)->groupBy('stock_id','stock_number','product_details');
            //dd($this->distributor_cusrrent_stock);
        }
    }

    public function updatedStockId($id)
    {
        if($this->stock_id)
        {
            $this->resetStock();

            $this->stock = Stock::where('id',$this->stock_id)->first();
            $this->unit_price = $this->stock->unit_price;
            $quantity_with_distributor = collect($this->distributor_cusrrent_stock)->where('stock_id',$this->stock_id)->sum('quantity');
            $quantity_in_list = collect($this->invoice_items)->where('stock_id',$this->stock_id)->sum('quantity');
            $this->quantity_available = $quantity_with_distributor - $quantity_in_list;
        }
    }

    public function addInvoiceItemToList()
    {
        $this->validate([
            'stock_id' => 'required|numeric',
            'unit_price' => 'required|numeric|min:1',
            'unit_discount' => 'nullable|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);

        $dupplicate_stock_count = collect($this->invoice_items)
                ->where('stock_id',$this->stock_id)
                ->where('is_free',$this->is_free ? '1' : '0')
                ->count('stock_id');

        if($dupplicate_stock_count > 0)
        {
            session()->flash('dupplicateStockId','Selected item is already exists in the list.');
        }
        else
        {
            if($this->quantity_available < $this->quantity)
            {
                session()->flash('invalidQuantity','Invalid quantity ! Please try again.');
            }
            else
            {
                $this->invoice_items[] = [
                'stock_id' => $this->stock_id,
                'stock_number' => $this->stock->number,
                'product_details' => $this->stock->product->product_details,
                'unit_price' => $this->unit_price,
                'unit_discount' => $this->unit_discount ?? '0',
                'quantity' =>   $this->quantity,
                'is_free' =>   $this->is_free  ? '1' : '0',
                'discount_total' =>   ($this->quantity * $this->unit_discount),
                'line_total' =>   ($this->quantity * ($this->unit_price - $this->unit_discount))
                ];

                session()->flash('successInvoiceItem','Completed Successfully !');
                $this->resetStock();
                $this->reset(['stock_id']);
                $this->invoiceItemsSummery();
            }
        }
    }

    public function invoiceItemsSummery()
    {
        $this->total_price = collect($this->invoice_items)->sum('line_total');
        $this->total_discount = collect($this->invoice_items)->sum('discount_total');
    }

    public function resetStock()
    {
        $this->reset(['stock','quantity_available','unit_price','unit_discount','quantity','is_free']);
    }

    public function resetDistributorStock()
    {
        $this->reset(['distributor_cusrrent_stock','stock','stock_id','quantity_available','unit_price','unit_discount','quantity','is_free']);
    }

    public function resetInvoice()
    {
        $this->reset(['invoice','invoice_id','distributor_id','customer_id','number','reference','date','invoice_items']);
        $this->date = date('Y-m-d');
    }

    public function removeInvoiceItemFromList($key)
    {
        unset($this->invoice_items[$key]);
        $this->resetStock();
        $this->reset(['stock_id']);
        $this->invoiceItemsSummery();
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
            //dd($this->invoice_items);
            $this->invoice = Invoice::updateOrCreate($validated_data);
            $this->invoice->invoice_items()->delete();
            $this->invoice->invoice_items()->createMany($this->invoice_items);

            session()->flash('successInvoice','Completed Successfully !');
            $this->resetInvoice();
            $this->invoiceItemsSummery();
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
