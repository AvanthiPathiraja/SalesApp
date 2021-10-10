<?php

namespace App\Http\Livewire\IssueReturn;

use App\Models\InvoiceItem;
use App\Models\InvoiceReturn;
use App\Models\IssueItem;
use App\Models\IssueNote;
use Livewire\Component;
use App\Models\IssueReturn;
use App\Models\Stock;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $search;
    protected $listeners = ['search'];
    public $distributor_id = 1;


    public function search($val)
    {
        $this->search = '%'.$val.'%';
    }

    public function stock_balance_data_set()
    {
        $issue_items = IssueItem::select('stock_id',DB::raw('sum(quantity) as issuedQuantity,'.'0 as returnedQuantity, 0 as invoicedQuantity'))
        ->where('is_cleared',0)
        ->whereHas('issue_note',function($issue_note){
            $issue_note
            ->where('distributor_id',$this->distributor_id);
        })
        ->groupBy('stock_id')
        ->get()->collect();

        $invoice_returns = InvoiceReturn::select('stock_id',DB::raw('0 as issuedQuantity,sum(quantity) as returnedQuantity, 0 as invoicedQuantity'))
                ->where('is_cleared',0)
                ->where('distributor_id',$this->distributor_id)
                ->groupBy('stock_id')
                ->get()->collect();

        $invoice_items = InvoiceItem::select('stock_id',DB::raw('0 as issuedQuantity,0 as returnedQuantity, sum(quantity) as invoicedQuantity'))
                ->where('is_cleared',0)
                ->whereHas('invoice',function($invoice){
                    $invoice->where('distributor_id',$this->distributor_id);
                })->groupBy('stock_id')
                ->get()->collect();


        $stocks = $invoice_items->merge($issue_items)->merge($invoice_returns)->unique('stock_id');

        $stock_products = Stock::with('product')->whereIn('id', $stocks->pluck('stock_id'))->get();

        return $this->map_stock_data($stocks, $issue_items,$invoice_returns, $invoice_items, $stock_products);

    }

    public function map_stock_data($stocks, $issue_items,$invoice_returns, $invoice_items, $stock_products)
    {
        return $stocks->map(function ($stock) use($issue_items,$invoice_returns, $invoice_items, $stock_products) {

            $issue_quantity = $issue_items->where('stock_id', $stock->stock_id)->first();
            $invoice_quantity = $invoice_items->where('stock_id', $stock->stock_id)->first();
            $return_quantity = $invoice_returns->where('stock_id', $stock->stock_id)->first();

            $stock_product = $stock_products->where('id', $stock->stock_id)->first();

            return [
                'product_name' => $stock_product->product->name,
                'issue_quantity' => $issue_quantity->issuedQuantity,
                'invoice_quantity' => $invoice_quantity->invoicedQuantity,
                'return_quantity' => $return_quantity->returnedQuantity
            ];

        });
    }



    public function render()
    {


        dd($this->stock_balance_data_set());


        return view('livewire.issue-return.index');
           // ->with(['issue_returns' => $issue_returns ]);
    }
}
