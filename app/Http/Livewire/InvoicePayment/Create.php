<?php

namespace App\Http\Livewire\InvoicePayment;

use App\Models\InvoicePayment;
use Livewire\Component;
use App\Models\Customer;

class Create extends Component
{
    public $customers = [];
    public $customer_id;

    public $invoice_payment;
    public $invoice_payment_id,$date,$number,$reference,$payment_type,$amount,$note;


    public function mount()
    {
        $this->customers = Customer::where('is_active',1)->get();

        if($this->invoice_payment)
        {
            $this->invoice_payment = InvoicePayment::findOrFail($this->invoice_payment);

            $this->invoice_payment_id = $this->invoice_payment->id;
            $this->customer_id = $this->invoice_payment->customer_id;
            $this->date = $this->invoice_payment->date;
            $this->reference = $this->invoice_payment->reference;
            $this->payment_type = $this->invoice_payment->payment_type;
            $this->amount = $this->invoice_payment->amount;
            $this->note = $this->invoice_payment->note;
        }
    }


    public function saveOrUpdateInvoicePayment()
    {
        $validated_data = $this->validate([
            'number' => 'required|numeric',
            'reference' => 'required|max:20',
            'date' => 'required|date',
            'customer_id' => 'required|numeric',
            'payment_type' => 'required',
            'amount' => 'required|numeric',
            'note' => 'nullable|max:150',
        ]);

        InvoicePayment::updateOrCreate($validated_data);
        session()->flash('success','Completed Successfully !');
    }

    public function deleteInvoicePayment(InvoicePayment $invoice_payment)
    {
        $invoice_payment->delete();
        return redirect()->route('invoice-payment.index');
    }

    public function render()
    {
        return view('livewire.invoice-payment.create');
    }
}
