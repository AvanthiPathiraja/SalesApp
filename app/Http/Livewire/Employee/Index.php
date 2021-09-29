<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Http\Livewire\Employee\Create as EmployeeCreate;


class Index extends EmployeeCreate
{
    public $employees=[];



    public function mount()
    {
        $this->employees=Employee::where('is_active',1)->get();
    }

    public function render()
    {
        return view('livewire.employee.index');
    }

}
