<?php

namespace App\Http\Livewire\InvoiceReturn;

use App\Models\InvoiceReturn;
use Livewire\Component;
use App\Http\Livewire\InvoiceReturn\Create as InvoiceReturnCreate;

class Index extends InvoiceReturnCreate
{
    public $invoice_returns = [];

    public function mount()
    {
       $this->invoice_returns = InvoiceReturn::where('id','<',10)->get();
      // dd($this->invoice_returns);
    }

    public function render()
    {
        return view('livewire.invoice-return.index');
    }
}
