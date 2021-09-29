<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Route;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers=Customer::with('route')->get();
        return view('customer.index',compact('customers'));
    }


    public function create()
    {
        $routes=Route::all();
        return view('customer.create',compact('routes'));
    }


    public function store(Request $request)
    {
        $validated_data=$request->validate([
            'number' => 'required|max:15',
            'name' => 'required|max:100',
            'contacted_person' => 'required|max:75',
            'telephone' => 'required|size:10',
            'mobile' => 'nullable|size:10',
            'route_id' => 'required|numeric',
            'address' => 'required|max:255',
            'email' => 'nullable|max:100',
            'note' => 'nullable|max:100'

        ]);

        Customer::create( $validated_data);

        return redirect()->back();


    }


    public function show(Customer $customer)
    {

    }


    public function edit(Customer $customer)
    {
        $routes=Route::all();
        return view('customer.edit',compact('routes','customer'));
    }


    public function update(Request $request, Customer $customer)
    {
        $validated_data=$request->validate([
            'number' => 'required|max:15',
            'name' => 'required|max:100',
            'contacted_person' => 'required|max:75',
            'telephone' => 'required|size:10',
            'mobile' => 'nullable|size:10',
            'route_id' => 'required|numeric',
            'address' => 'required|max:255',
            'email' => 'nullable|max:100',
            'note' => 'nullable|max:100'

        ]);

        $customer->update($validated_data);

        return redirect()->back();
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back();
    }
}
