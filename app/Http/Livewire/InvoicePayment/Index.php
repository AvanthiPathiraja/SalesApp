<?php

namespace App\Http\Livewire\InvoicePayment;

use App\Models\InvoicePayment;
use App\Http\Livewire\InvoicePayment\Create as InvoicePaymentCreate;

class Index extends InvoicePaymentCreate
{
    public $invoice_payments = [];
    public $search_key;

    public function mount()
    {
        $this->invoice_payments = InvoicePayment::where('is_active',1)->get();
    }

    public function searchPayments()
    {
        $this->invoice_payments = InvoicePayment::where([
            ['is_active',1],
            ['number','like',$this->search_key],
        ])
        ->get();
    }


    public function render()
    {
        return view('livewire.invoice-payment.index');
    }
}
