<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class APIProductController extends Controller
{
    public function index()
    {
        $product = Product::select('id', 'name', 'price', 'qty', 'sumary')->get();
        return response()->json($product, 200);
    }
    public function create(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
    public function show($id)
    {
        $product = Product::select('id', 'name', 'price', 'qty', 'sumary')->where('id', $id)->first();
        return response()->json($product, 200);
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product, 204);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json($product, 204);
    }
}
