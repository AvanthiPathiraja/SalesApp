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
            ->where(function($invoice_payment){
                $invoice_payment
                ->where('number','like','%'.$this->search.'%')
                ->orWhere('reference','like','%'.$this->search.'%')
                ->orWhere('date','like','%'.$this->search.'%')
                ->orWhere('note','like','%'.$this->search.'%')
                ->orWhere('amount','like','%'.$this->search.'%')
                ->orWhere('payment_type','like','%'.$this->search.'%');
            })
            ->orWhereHas('customer',function($customer){
                $customer
                ->where('name','like','%'.$this->search.'%');
            })
            ->paginate(10);

        return view('livewire.invoice-payment.index')
            ->with(['invoice_payments' => $invoice_payments]);
    }
}
