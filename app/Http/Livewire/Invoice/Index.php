<?php

namespace App\Http\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;
use App\Http\Livewire\Invoice\Create as InvoiceCreate;

class Index extends InvoiceCreate
{
    public $invoices = [];

    public function mount()
    {
         $this->invoices = Invoice::all();
    }

    public function render()
    {
        return view('livewire.invoice.index');
    }
}
