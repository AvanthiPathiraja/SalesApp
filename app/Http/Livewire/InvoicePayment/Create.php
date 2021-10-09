<?php

namespace App\Http\Livewire\InvoicePayment;

use App\Models\Invoice;
use Livewire\Component;
use App\Models\Customer;
use App\Models\InvoicePayment;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $customers = [];
    public $customer_id,$due_amount;

    public $invoice_payment;
    public $invoice_payment_id,$date,$number,$reference,$payment_type,$amount,$note;


    public function mount()
    {
        $this->customers = Customer::where('is_active',1)->get();
        $this->date = date('Y-m-d');
        $this->payment_type = 'Cash';

        if($this->invoice_payment)
        {
            $this->invoice_payment = InvoicePayment::findOrFail($this->invoice_payment);

            $this->invoice_payment_id = $this->invoice_payment->id;
            $this->customer_id = $this->invoice_payment->customer_id;
            $this->date = $this->invoice_payment->date;
            $this->number = $this->invoice_payment->number;
            $this->reference = $this->invoice_payment->reference;
            $this->payment_type = $this->invoice_payment->payment_type;
            $this->amount = $this->invoice_payment->amount;
            $this->note = $this->invoice_payment->note;
        }
    }

    public function updatedCustomerId()
    {
        if($this->customer_id)
        {
            $customer_invoices = Invoice::select(DB::raw('sum(total_price-total_discount) as payment_due'))
                ->where('customer_id',$this->customer_id)
                ->where('is_active',1)
                ->first();

            $customer_payments = InvoicePayment::select(DB::raw('sum(amount) as paid_total'))
                ->where('customer_id',$this->customer_id)
                ->where('is_active',1)
                ->first();

            $this->due_amount =  ($customer_invoices->payment_due -  $customer_payments->paid_total) ?? '0';
        }
    }

    public function saveOrUpdateInvoicePayment()
    {
        $validated_data = $this->validate([
            'number' => 'required|max:20',
            'reference' => 'nullable|max:20',
            'date' => 'required|date',
            'customer_id' => 'required|numeric',
            'payment_type' => 'required',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|max:150',
        ]);

        if($this->due_amount < $this->amount)
        {
            session()->flash('invalidAmount','Invalid amount. Please try again.');
        }
        else
        {
            InvoicePayment::updateOrCreate(['id' => $this->invoice_payment_id ?? null],$validated_data);
            session()->flash('success','Completed Successfully !');
            $this->resetPayment();
        }
    }

    public function resetPayment()
    {
        $this->reset(['invoice_payment','invoice_payment_id','customer_id','date','number','reference','payment_type','amount','note',
        'due_amount']);
        $this->date = date('Y-m-d');
        $this->payment_type = 'Cash';
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
