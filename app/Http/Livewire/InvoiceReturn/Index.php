<?php

namespace App\Http\Livewire\InvoiceReturn;

use App\Models\InvoiceReturn;
use Livewire\Component;
use App\Http\Livewire\InvoiceReturn\Create as InvoiceReturnCreate;
use Livewire\WithPagination;

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
        $invoice_returns = InvoiceReturn::paginate(10);

        return view('livewire.invoice-return.index')
            ->with(['invoice_returns' => $invoice_returns]);
    }
}
