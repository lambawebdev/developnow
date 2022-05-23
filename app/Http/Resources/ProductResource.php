<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'name' => $this->resource->name,
			'price' => $this->resource->price,
			'category_id' => $this->resource->category_id,
			'image' => $this->resource->image,
			'created_at' => $this->resource->created_at,
			'updated_at' => $this->resource->updated_at,
		];
	}
}
