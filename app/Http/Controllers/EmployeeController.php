<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        return view('employee.index',compact('employees'));
    }


    public function create()
    {
        return view('employee.create');
    }


    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'number' => 'required|max:10',
            'title' => 'required|max:10',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'date_of_birth' => 'required|date',
            'nic_number' => 'required|max:12',
            'driving_lisence_number' => 'nullable|max:20',
            'telephone' => 'required|size:10',
            'mobile' => 'nullable|size:10',
            'address' => 'required|max:255',
            'email' => 'nullable|max:100',
        ]);

        Employee::create($validated_data);
        return redirect()->back();

    }


    public function show(Employee $employee)
    {

    }


    public function edit(Employee $employee)
    {
        return view('employee.edit',compact('employee'));
    }


    public function update(Request $request, Employee $employee)
    {
        $validated_data = $request->validate([
            'number' => 'required|max:10',
            'title' => 'required|max:10',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'date_of_birth' => 'required|date',
            'nic_number' => 'required|max:12',
            'driving_lisence_number' => 'nullable|max:20',
            'telephone' => 'required|size:10',
            'mobile' => 'nullable|size:10',
            'address' => 'required|max:255',
            'email' => 'nullable|max:100',
        ]);

        $employee->update($validated_data);
        return redirect()->back();

    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->back();
    }
}
