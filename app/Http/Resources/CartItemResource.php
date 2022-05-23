<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
	public function toArray($request)
	{
		$data = [];

		foreach ($this->resource->products as $product) {
			$data = [
				'product_id' => $this->resource->product_id,
				'product_category' => $product->productCategory->name,
				'created_at' => $this->resource->created_at,
				'updated_at' => $this->resource->updated_at,
			];
		}

		return $data;
	}
}
