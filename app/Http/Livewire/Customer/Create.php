<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use App\Models\Route;
use Livewire\Component;

class Create extends Component
{

    public $routes = [];
    public $route_id;

    public $customer;
    public $customer_id,$number,$name,$contacted_person,$telephone,$mobile,$address,$email,$note;

    public function mount()
    {
        $this->routes = Route::all();

        if($this->customer)
        {
            $this->customer = Customer::findOrFail($this->customer);

            $this->customer_id = $this->customer->id;
            $this->number = $this->customer->number;
            $this->name = $this->customer->name;
            $this->contacted_person = $this->customer->contacted_person;
            $this->telephone = $this->customer->telephone;
            $this->mobile = $this->customer->mobile;
            $this->address = $this->customer->address;
            $this->email = $this->customer->email;
            $this->note = $this->customer->note;
            $this->route_id = $this->customer->route_id;
        }
    }

    public function saveOrUpdateCustomer()
    {
        $validated_data = $this->validate([
            'number' => 'required|max:15',
            'name' => 'required|max:100',
            'contacted_person' => 'required|max:75',
            'telephone' => 'required|size:10',
            'mobile' => 'nullable|size:10',
            'route_id' => 'required|numeric',
            'address' => 'required|max:255',
            'email' => 'nullable|email',
            'note' => 'nullable|max:100'
        ]);

        $this->customer = Customer::updateOrCreate(['id' => $this->customer_id ?? null],$validated_data);
        $this->customer_id = $this->customer->id;
        session()->flash('success','Completed Successfully !');
        //return redirect()->back();
    }

    public function resetCustomer()
    {
        $this->reset(['customer','customer_id','number','name','contacted_person','telephone','mobile','email','route_id','address','note']);
    }

    public function deleteCustomer(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index');
    }



    public function render()
    {
        return view('livewire.customer.create');
    }
}
