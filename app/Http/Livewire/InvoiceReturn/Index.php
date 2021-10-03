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
        $invoice_returns = InvoiceReturn::where(DB::raw('concat(date)'),'like','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.invoice-return.index')
            ->with(['invoice_returns' => $invoice_returns]);
    }
}
