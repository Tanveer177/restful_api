<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            "success" => true,
            "message" => "Records retrieved successfully",
            "data" => $products,
        ], 200);
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            "success" => true,
            "message" => "Record add successfully",
            "data" => $product,
        ], 201);
    }
    public function show(Product $product)
    {
        return response()->json([
            "success" => true,
            "message" => "Record retrieved successfully",
            "data" => $product
        ], 200);
    }
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ]);
        $product->update($validatedData);
        return response()->json([
            "success" => true,
            "message" => "Record updated successfully",
            "data" => $product
        ], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            "success" => true,
            "message" => "Record deleted successfully"
        ], 200);
    }
}
