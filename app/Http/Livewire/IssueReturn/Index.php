<?php

namespace App\Http\Livewire\IssueReturn;

use App\Models\Stock;
use Livewire\Component;
use App\Models\Employee;
use App\Models\IssueItem;
use App\Models\IssueNote;
use App\Models\InvoiceItem;
use App\Models\IssueReturn;
use Livewire\WithPagination;
use App\Models\InvoiceReturn;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $search;
    protected $listeners = ['search'];
    public $distributors = [];
    public $distributor_id;
    public $distributor_stock_report = [];


    public function search($val)
    {
        $this->search = $val;
    }

    public function mount()
    {
        $this->distributors = Employee::where('is_active',1)->get();

    }

    public function updatedDistributorId()
    {
        if($this->distributor_id)
        {
            $this->distributor_stock_report = $this->getDistributorStockReport();
        }
    }

    public function getDistributorStockReport()
    {
        $issue_items = IssueItem::select([
            'stock_id',
            DB::raw('sum(quantity) as issued_qty'),
            DB::raw('0 as customer_returned_qty'),
            DB::raw('0 as invoiced_qty'),
            DB::raw('0 as distributor_returned_qty'),
        ])
        ->where('is_cleared',0)
        ->whereHas('issue_note',function($issue_note){
            $issue_note->where('distributor_id',$this->distributor_id)
            ->where('is_active',1);
        })->groupBy('stock_id');

        $invoice_returns = InvoiceReturn::select([
            'stock_id',
            DB::raw('0 as issued_qty'),
            DB::raw('sum(quantity) as customer_returned_qty'),
            DB::raw('0 as invoiced_qty'),
            DB::raw('0 as distributor_returned_qty'),
        ])
        ->where('is_cleared',0)
        ->where('distributor_id',$this->distributor_id)
        ->groupBy('stock_id');

        $invoice_items = InvoiceItem::select([
            'stock_id',
            DB::raw('0 as issued_qty'),
            DB::raw('0 as customer_returned_qty'),
            DB::raw('sum(quantity) as invoiced_qty'),
            DB::raw('0 as distributor_returned_qty'),
        ])
        ->where('is_cleared',0)
        ->whereHas('invoice',function($invoice){
            $invoice->where('distributor_id',$this->distributor_id)
            ->where('is_active',1);
        })->groupBy('stock_id');

        $distributor_returns = IssueReturn::select([
            'stock_id',
            DB::raw('0 as issued_qty'),
            DB::raw('0 as customer_returned_qty'),
            DB::raw('0 as invoiced_qty'),
            DB::raw('sum(quantity) as distributor_returned_qty'),
        ])
        ->where('distributor_id',$this->distributor_id)
        ->groupBy('stock_id');

        $distributor_stock = $issue_items->unionAll($invoice_returns)->unionAll($invoice_items)->unionAll($distributor_returns)->get();

        $stock_products = Stock::with('product')->whereIn('id', $distributor_stock->unique('stock_id')->pluck('stock_id'))->get();

        return $distributor_stock->groupBy('stock_id')->map(function ($stock, $keys) use($stock_products)
        {
            $stock_product = $stock_products->where('id', $keys)->first();
            return [
                'stock_id' => $stock_product->id,
                'stock_number' => $stock_product->number,
                'product_details' => $stock_product->product->name,
                'issued_qty' => $stock->sum('issued_qty'),
                'customer_returned_qty' => $stock->sum('customer_returned_qty'),
                'invoiced_qty' => $stock->sum('invoiced_qty'),
                'distributor_returned_qty' => $stock->sum('distributor_returned_qty'),
                'due_balance' => ($stock->sum('issued_qty') + $stock->sum('customer_returned_qty'))
                            - ( $stock->sum('invoiced_qty') + $stock->sum('distributor_returned_qty')),
            ];
        })
        ->toArray();
    }

    public function render()
    {
        return view('livewire.issue-return.index')
           ->with(['distributor_stocks' => $this->distributor_stock_report ]);
    }
}
