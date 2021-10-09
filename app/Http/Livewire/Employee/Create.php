<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;

class Create extends Component
{
    public $employee;
    public $employee_id;
    public $number,$title,$first_name,$last_name,$date_of_birth,$nic_number,$driving_lisence_number,$telephone,$mobile,$address,$email,$designation;

    public function mount()
    {
        if ($this->employee) {

             $this->employee=Employee::findOrFail($this->employee);

             $this->employee_id = $this->employee->id;
             $this->number = $this->employee->number;
             $this->title = $this->employee->title;
             $this->first_name = $this->employee->first_name;
             $this->last_name = $this->employee->last_name;
             $this->date_of_birth = $this->employee->date_of_birth;
             $this->nic_number = $this->employee->nic_number;
             $this->driving_lisence_number = $this->employee->driving_lisence_number;
             $this->telephone = $this->employee->telephone;
             $this->mobile = $this->employee->mobile;
             $this->address = $this->employee->address;
             $this->email = $this->employee->email;
             $this->designation = $this->employee->designation;
        }
    }

    public function saveOrUpdateEmployee()
    {
        $validated_data = $this->validate([
            'number' => 'required|max:10',
            'title' => 'required|max:10',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'date_of_birth' => 'nullable|date',
            'nic_number' => 'nullable|max:12',
            'driving_lisence_number' => 'nullable|max:20',
            'telephone' => 'required|size:10',
            'mobile' => 'nullable|size:10',
            'address' => 'required|max:255',
            'email' => 'nullable|email',
            'designation' => 'required|max:100'
        ]);

        Employee::updateOrCreate(['id'=>$this->employee_id ?? null],$validated_data);
        session()->flash('success','Successfully completed !');
        $this->resetEmployee();
    }

    public function resetEmployee()
    {
        $this->reset(['employee','employee_id','number','title','first_name','last_name',
        'date_of_birth','nic_number','driving_lisence_number','telephone','mobile','email','address','designation']);
    }

    public function deleteEmployee(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index');
    }


    public function render()
    {
        return view('livewire.employee.create');
    }
}
