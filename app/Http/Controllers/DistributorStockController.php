<?php

namespace App\Http\Controllers;

use App\Models\DistributorStock;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class DistributorStockController extends Controller
{

    public function index()
    {
        $distributor_stocks = DistributorStock::all();
        return view('distributor-stock.index',compact('distributor_stocks'));
    }

    public function create()
    {
        $distributors = Employee::all();
        $products = Product::all();
        return view('distributor-stock.create',compact('distributors','products'));
    }


    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'product_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'distributor_id' => 'required|numeric',
            'date' => 'required|date',
            'quantity' => 'required|numeric'

        ]);

        DistributorStock::create($validated_data);
        return redirect()->back();
    }


    public function show(DistributorStock $distributorStock)
    {
        //
    }


    public function edit(DistributorStock $distributorStock)
    {
        $distributors = Employee::all();
        $products = Product::all();
        return view('distributor-stock.edit',compact('distributors','products','distributorStock'));
    }


    public function update(Request $request, DistributorStock $distributorStock)
    {
        $validated_data = $request->validate([
            'product_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'distributor_id' => 'required|numeric',
            'date' => 'required|date',
            'quantity' => 'required|numeric'

        ]);

        $distributorStock->update($validated_data);
        return redirect()->back();
    }


    public function destroy(DistributorStock $distributorStock)
    {
        $distributorStock->delete();
        return redirect()->back();
    }
}
