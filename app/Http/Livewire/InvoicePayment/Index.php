<?php

namespace App\Http\Livewire\InvoicePayment;

use App\Models\InvoicePayment;
use App\Http\Livewire\InvoicePayment\Create as InvoicePaymentCreate;
use Livewire\WithPagination;

class Index extends InvoicePaymentCreate
{
    use WithPagination;

    public $search;
    protected $listners = [];

    public function search($val)
    {
        $this->search = '%'.$val.'%';
    }


    public function render()
    {
        $invoice_payments = InvoicePayment::where('is_active',1)
            ->paginate(10);

        return view('livewire.invoice-payment.index')
            ->with(['invoice_payments' => $invoice_payments]);
    }
}
