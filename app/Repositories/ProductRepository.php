<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
	public function getAllProducts()
	{
		return Product::with('productCategory')->get();
	}

	public function deleteProduct(Product $product)
	{
		$product->delete();

		return $product;
	}

	public function createProduct(ProductRequest $request)
	{
		return Product::create($request->validated());
	}

	public function updateProduct(ProductRequest $request, Product $product)
	{
		$product->fill($request->validated());
		$product->save();

		return $product->refresh();
	}
}
