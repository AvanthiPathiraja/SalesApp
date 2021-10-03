<?php

namespace App\Http\Livewire\InvoicePayment;

use Livewire\WithPagination;
use App\Models\InvoicePayment;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\InvoicePayment\Create as InvoicePaymentCreate;

class Index extends InvoicePaymentCreate
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
        $invoice_payments = InvoicePayment::where('is_active',1)
            ->where(DB::raw('concat(number,reference,date)'),'like','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.invoice-payment.index')
            ->with(['invoice_payments' => $invoice_payments]);
    }
}
