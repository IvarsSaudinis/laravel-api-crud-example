<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('attributes')->paginate();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $product = Product::findOrFail($id);

       return response()->json(['status'=> 'Success', 'data' => $product->load('attributes')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        $product->update($request->all());

        return response()->json(['status'=> 'Success', 'data' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return response()->json(['status'=> 'Success', 'message' => 'Product deleted successfully'], 200);
    }
}
