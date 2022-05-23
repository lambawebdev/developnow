<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
	private ProductRepositoryInterface $productRepository;

	public function __construct(ProductRepositoryInterface $productRepository)
	{
		$this->productRepository = $productRepository;
	}

    public function index()
    {
        return ProductResource::collection(
			$this->productRepository->getAllProducts()
        );
    }

    public function store(ProductRequest $request)
    {
        return new ProductResource($this->productRepository->createProduct($request));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        return new ProductResource($this->productRepository->updateProduct($request, $product));
    }

    public function destroy(Product $product)
    {
        return new ProductResource($this->productRepository->deleteProduct($product));
    }
}
