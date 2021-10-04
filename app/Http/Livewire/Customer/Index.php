<?php

namespace App\Http\Livewire\Customer;

use App\Models\Route;

use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;
use App\Http\Livewire\Customer\Create as CustomerCreate;

class Index extends CustomerCreate
{
    use WithPagination;

    public $search;
    protected $listeners = ['search'];

    public $routes = [];
    public $route_id;

    public function search($val)
    {
        $this->search = $val;
    }

    public function mount()
    {
        $this->routes = Route::where('is_active',1)->get();
    }


    public function render()
    {
        $customers = '';
        if($this->route_id)
        {
            $customers = Customer::where('is_active',1)
                ->where(function ($customer){
                    $customer
                        ->where('number','like','%'.$this->search.'%')
                        ->orWhere('name','like','%'.$this->search.'%')
                        ->orWhere('contacted_person','like','%'.$this->search.'%')
                        ->orWhere('telephone','like','%'.$this->search.'%')
                        ->orWhere('mobile','like','%'.$this->search.'%');
                })
                ->whereHas('route',function ($route) {
                    $route->where('id',$this->route_id);
                })
                ->paginate(10);
        }
        else
        {
            $customers = Customer::where('is_active',1)
            ->where(function ($customer){
                $customer
                    ->where('number','like','%'.$this->search.'%')
                    ->orWhere('name','like','%'.$this->search.'%')
                    ->orWhere('contacted_person','like','%'.$this->search.'%')
                    ->orWhere('telephone','like','%'.$this->search.'%')
                    ->orWhere('mobile','like','%'.$this->search.'%');
            })
            ->paginate(10);
        }

        return view('livewire.customer.index')->with([
            'customers' => $customers
        ]);
    }
}
