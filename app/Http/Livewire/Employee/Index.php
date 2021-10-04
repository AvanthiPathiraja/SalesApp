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
            ->where(DB::raw('concat(title,first_name,last_name,nic_number,telephone,designation)'),'like','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.employee.index')
            ->with(['employees' => $employees ]);
    }

}
