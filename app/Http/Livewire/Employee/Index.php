<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Employee\Create as EmployeeCreate;


class Index extends EmployeeCreate
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
        $employees = Employee::where('is_active',1)
            ->where(function($employee){
                $employee
                    ->where('number','like','%'.$this->search.'%')
                    ->orWhere('title','like','%'.$this->search.'%')
                    ->orWhere('first_name','like','%'.$this->search.'%')
                    ->orWhere('last_name','like','%'.$this->search.'%')
                    ->orWhere('nic_number','like','%'.$this->search.'%')
                    ->orWhere('telephone','like','%'.$this->search.'%')
                    ->orWhere('mobile','like','%'.$this->search.'%')
                    ->orWhere('designation','like','%'.$this->search.'%');
            })
            ->paginate(10);

        return view('livewire.employee.index')
            ->with(['employees' => $employees ]);
    }

}
