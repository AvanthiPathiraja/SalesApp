<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;
use App\Http\Livewire\Invoice\Create as InvoiceCreate;
use Livewire\WithPagination;

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
        $invoices = Invoice::where('is_active',1)->where('number', 'LIKE', '%'. $this->search . '%' )->paginate(10);
        return view('livewire.invoice.index')
            ->with(['invoices' => $invoices]);
    }
}
