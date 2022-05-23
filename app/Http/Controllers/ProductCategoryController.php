<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return ProductCategoryResource::collection(
			ProductCategory::all()
        );
    }

    public function store(ProductCategoryRequest $request)
    {
        $productCategory = ProductCategory::create($request->validated());

        return new ProductCategoryResource($productCategory);
    }

    public function show(ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
		$productCategory->fill($request->validated());
		$productCategory->save();

		$productCategory->refresh();

        return new ProductCategoryResource($productCategory);
    }

    public function destroy(ProductCategory $productCategory)
    {
		$productCategory->delete();

        return new ProductCategoryResource($productCategory);
    }
}
