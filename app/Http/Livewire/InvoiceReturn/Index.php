<?php

namespace App\Http\Livewire\InvoiceReturn;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InvoiceReturn;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\InvoiceReturn\Create as InvoiceReturnCreate;

class Index extends InvoiceReturnCreate
{
    use WithPagination;

    public $search;
    protected $listeners = ['search'];

    public function search($val)
    {
        $this->search = $val;
    }

    public function render()
    {
        $invoice_returns = InvoiceReturn::where(function($invoice_return){
            $invoice_return
            ->where('date','like','%'.$this->search.'%')
            ->orWhere('quantity','like','%'.$this->search.'%')
            ->orWhere('reason','like','%'.$this->search.'%');
        })
        ->orWhereHas('invoice',function($invoice){
            $invoice
            ->where('number','like','%'.$this->search.'%')
            ->orWhereHas('customer',function($customer){
                $customer
                ->where('name','like','%'.$this->search.'%');
            });
        })
        ->orWhereHas('distributor',function($distributor){
            $distributor
            ->where(DB::raw('concat(title," ",first_name," ",last_name)'),'like','%'.$this->search.'%');
        })
        ->orWhereHas('stock',function($stock){
            $stock
            ->where('number','like','%'.$this->search.'%')
            ->orWhereHas('product',function($product){
                $product
                ->where('category','like','%'.$this->search.'%')
                ->orWhere('name','like','%'.$this->search.'%');
            });
        })
        ->paginate(10);

        return view('livewire.invoice-return.index')
            ->with(['invoice_returns' => $invoice_returns]);
    }
}
