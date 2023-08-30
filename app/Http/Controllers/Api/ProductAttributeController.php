<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductAttributeRequest;
use App\Http\Requests\UpdateProductAttributeRequest;
use App\Http\Resources\ProductAttributeResource;
use App\Models\ProductAttribute;
use http\Client\Response;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productAttributes = ProductAttribute::paginate();

        return ProductAttributeResource::collection($productAttributes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductAttributeRequest $request)
    {
        $productAttribute = ProductAttribute::create($request->all());

        return new ProductAttributeResource($productAttribute);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttribute $productAttribute)
    {
        return new ProductAttributeResource($productAttribute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductAttributeRequest $request, ProductAttribute $productAttribute)
    {
        $productAttribute->update($request->all());

        return new ProductAttributeResource($productAttribute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttribute $productAttribute)
    {
        $productAttribute->delete();

        return response(null, 204);
    }
}
