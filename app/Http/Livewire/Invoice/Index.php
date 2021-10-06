<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Invoice\Create as InvoiceCreate;
use App\Models\InvoiceReturn;

class Index extends InvoiceCreate
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
        $invoices = Invoice::where('is_active',1)
            ->where(function($invoice){
                $invoice
                ->where('number', 'LIKE', '%'. $this->search . '%' )
                ->orWhere('reference', 'LIKE', '%'. $this->search . '%' )
                ->orWhere('date', 'LIKE', '%'. $this->search . '%' )
                ->orWhere('total_price', 'LIKE', '%'. $this->search . '%' )
                ->orWhere('total_discount', 'LIKE', '%'. $this->search . '%' );
            })
            ->orWhereHas('customer',function($customer){
                $customer
                ->where('name', 'LIKE', '%'. $this->search . '%' );

            })
            ->orWhereHas('distributor',function($distributor){
                $distributor
                ->where(DB::raw('concat(title," ",first_name," ",last_name)'), 'LIKE', '%'. $this->search . '%' );
            })
            ->paginate(10);

        return view('livewire.invoice.index')
            ->with(['invoices' => $invoices]);
    }
}
