<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.index',compact('invoices'));
    }


    public function create()
    {
        $customers = Customer::all();
        $distributors = Employee::all();
        return view('Invoice.create',compact('customers','distributors'));
    }


    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'number' => 'required|max:20',
            'customer_id' => 'required|numeric',
            'distributor_id' => 'required|numeric',
            'total_price' => 'required|numeric',
            'total_discount' => 'required|numeric'

        ]);

        $invoice = Invoice::create($validated_data);

        $customers = Customer::all();
        $distributors = Employee::all();
        $invoice_items = InvoiceItem::all();
        return view('Invoice.edit',compact('customers','distributors','invoice','invoice_items'));
    }


    public function show(Invoice $invoice)
    {
        //
    }


    public function edit(Invoice $invoice)
    {
        // $customers = Customer::all();
        // $distributors = Employee::all();
        // return view('Invoice.edit',compact('customers','distributors','invoice'));
    }


    public function update(Request $request, Invoice $invoice)
    {
        $validated_data = $request->validate([
            'number' => 'required|max:20',
            'customer_id' => 'required|numeric',
            'distributor_id' => 'required|numeric',
            'total_price' => 'required|numeric',
            'total_discount' => 'required|numeric'

        ]);

        $invoice->update($validated_data);
        return redirect()->back();
    }


    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->back();
    }
}
