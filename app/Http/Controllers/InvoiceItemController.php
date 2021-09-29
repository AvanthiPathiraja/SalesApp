<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Invoice $invoice)
    {
        return $invoice;
         //return view('invoice_item.create',compact('invoice'));
    }


    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'invoice_id' => 'required|max:20',
            'distributor_stock_id' => 'required|numeric',
            'sold_price' => 'required|numeric',
            'quantity' => 'required|numeric'

        ]);

        InvoiceItem::create($validated_data);
        return redirect()->back();
    }


    public function show(InvoiceItem $invoiceItem)
    {
        //
    }


    public function edit(InvoiceItem $invoiceItem)
    {
        //
    }


    public function update(Request $request, InvoiceItem $invoiceItem)
    {
        //
    }


    public function destroy(InvoiceItem $invoiceItem)
    {
        //
    }
}
