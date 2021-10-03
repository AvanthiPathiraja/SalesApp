<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Invoice\Create as InvoiceCreate;

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
            ->where(DB::raw('concat(number,reference,date)'), 'LIKE', '%'. $this->search . '%' )
            ->paginate(10);
        return view('livewire.invoice.index')
            ->with(['invoices' => $invoices]);
    }
}
