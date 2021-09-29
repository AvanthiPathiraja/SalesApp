<?php

namespace App\Http\Livewire\InvoicePayment;

use App\Http\Resources\InvoicePayment;
use Livewire\Component;
use App\Http\Livewire\InvoicePayment\Create as InvoicePaymentCreate;

class Index extends InvoicePaymentCreate
{
    public $invoice_payments = [];

    public function mount()
    {
        $this->invoice_payments = InvoicePayment::where('is_active',1)->get();
        //$this->invoice_payments = InvoicePayment::all();
    }

    public function render()
    {
        return view('livewire.invoice-payment.index');
    }
}
