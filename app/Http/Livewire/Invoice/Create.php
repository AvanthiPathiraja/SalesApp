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
use App\Models\IssueNote;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $customers = [];
    public $customer_id;

    public $distributors = [];
    public $distributor_id;

    public $issue_items = [];
    public $issue_item_id;


    public $invoice, $invoice_id, $number,$reference, $date, $total_price,$total_discount;

    public $invoice_items = [];
    public $invoice_item_id,$unit_price,$unit_discount,$quantity,$is_free;

    public function mount()
    {
        $this->customers = Customer::where('is_active',1)->get();
        $this->distributors = Employee::where([
            ['is_active','=','1'],
            ['designation','=','Distributor']
        ])->get();

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
                    'issue_item_id' => $invoice_item->distributor_stock_id,
                    'product_details' => "{$invoice_item->issue_item->stock->number} - {$invoice_item->issue_item->product->product_details}",
                    'unit_details' => $invoice_item->issue_item->product->unit_details,
                    'unit_price' => $invoice_item->sold_price,
                    'unit_discount' => $invoice_item->discount,
                    'quantity' =>   $invoice_item->quantity,
                    'is_free' => $invoice_item->is_free,
                    'discount_total' =>   ($invoice_item->quantity * $invoice_item->discount),
                    'line_total' =>   ($invoice_item->quantity * ($invoice_item->sold_price - $invoice_item->discount))
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

            $this->issue_items = DB::table('issue_notes as in')
            ->join('issue_items as i', 'i.issue_note_id', 'in.id')
            ->join('products as p', 'i.product_id', 'p.id')
            ->join('stocks as s', 'i.stock_id', 's.id')
            ->select(['i.id','i.quantity','p.category','p.name','p.unit','p.metric','p.size','s.number','s.unit_price'])
            ->where('in.distributor_id',$this->distributor_id)
            ->get();

           // dd($this->issue_items);


        }
    }

    public function updatedIssueItemId($id)
    {
        if($this->issue_item_id)
        {
            $issue_item = collect($this->issue_items)->where('id',$id)->first();

            $this->unit_price = $issue_item->unit_price;
            //$this->quantity_available = $this->selected_distributor_stock->quantity;
            //dd($this->quantity_available);
        }
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

        if(collect($this->invoice_items)->count() >0)
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

    public function addInvoiceItemToList()
    {
        $this->validate([
            'issue_item_id' => 'required|numeric',
            'unit_price' => 'required|numeric|min:1',
            'unit_discount' => 'nullable|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);

        $selected_issue_item = collect($this->issue_items)->where('id', $this->issue_item_id)->first();

        $display_is_free = 'no';
        $insert_is_free = '0';
        if($this->is_free)
        {
            $display_is_free = 'yes';
            $insert_is_free = '1';
        }


        $this->invoice_items[] = [
            'issue_item_id' => $selected_issue_item->id,
            'product_details' => $selected_issue_item->product->product_details,
            'unit_details' => $selected_issue_item->product->unit_details,
            'unit_price' => $this->unit_price,
            'unit_discount' => $this->unit_discount,
            'quantity' =>   $this->quantity,
            'display_is_free' =>   $display_is_free,
            'is_free' =>   $insert_is_free,
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
