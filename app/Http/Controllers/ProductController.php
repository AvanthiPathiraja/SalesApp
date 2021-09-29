<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('Product.index',compact('products'));
    }


    public function create()
    {
        return view('product.create');
    }


    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'number' => 'required|max:20',
            'brand_id' => 'nullable',
            'category' => 'required|max:70',
            'name' => 'required|max:100',
            'unit' => 'required|max:20',
            'metric' => 'nullable|max:70',
            'size' => 'nullable|numeric',
            'minimum_stock' => 'nullable|numeric',
            'unit_price' => 'required|numeric'
        ]);

       Product::create($validated_data);
        return redirect()->back();

    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        return view('Product.edit',compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $validated_data = $request->validate([
            'number' => 'required|max:20',
            'brand_id' => 'nullable',
            'category' => 'required|max:70',
            'name' => 'required|max:100',
            'unit' => 'required|max:20',
            'metric' => 'nullable|max:70',
            'size' => 'nullable|numeric',
            'minimum_stock' => 'nullable|numeric',
            'unit_price' => 'required|numeric'
        ]);

        $product->update($validated_data);
        return redirect()->back();
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}
