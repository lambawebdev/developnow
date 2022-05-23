<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'name' => $this->resource->name,
			'created_at' => $this->resource->created_at,
			'updated_at' => $this->resource->updated_at,
		];
	}
}
