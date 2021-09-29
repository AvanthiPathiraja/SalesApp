<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;

use App\Http\Livewire\Customer\Create as CustomerCreate;
use Livewire\WithPagination;

class Index extends CustomerCreate
{
    use WithPagination;

    public function render()
    {
        $customers = Customer::where('is_active',1)->paginate(10);
        return view('livewire.customer.index')->with([
            'customers' => $customers
        ]);
    }
}
