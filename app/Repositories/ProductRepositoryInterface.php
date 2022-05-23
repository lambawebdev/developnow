<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

interface ProductRepositoryInterface
{
	public function getAllProducts();
	public function deleteProduct(Product $product);
	public function createProduct(ProductRequest $request);
	public function updateProduct(ProductRequest $request, Product $product);
}
