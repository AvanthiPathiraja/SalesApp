<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index()
    {
        $stocks = Stock::with('product')->get();
        return view('stock.index',compact('stocks'));
    }


    public function create()
    {
        return view('Stock.create');
    }


    public function store(Request $request)
    {
        // $validated_data = $request->validate([
        //     'number' => 'required|max:20',
        //     'date' => 'required|date',
        //     'product_id' => 'required|numeric',
        //     'selling_price' => 'required|numeric',
        //     'quantity' => 'required|numeric',
        //     'expire_date' => 'required|date',
        // ]);

        // Stock::create($validated_data);
        // return redirect()->back();
    }


    public function show(Stock $stock)
    {

    }


    public function edit(Stock $stock)
    {

        return view('Stock.edit',compact('stock'));
    }


    public function update(Request $request, Stock $stock)
    {
        // $validated_data = $request->validate([
        //     'number' => 'required|max:20',
        //     'date' => 'required|date',
        //     'product_id' => 'required|numeric',
        //     'selling_price' => 'required|numeric',
        //     'quantity' => 'required|numeric',
        //     'expire_date' => 'required|date',
        // ]);

        // $stock->update($validated_data);
        // return redirect()->back();
    }


    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->back();
    }
}
