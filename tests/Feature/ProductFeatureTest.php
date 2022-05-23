<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
	use RefreshDatabase;

	public function setUp(): void
    {
		parent::setUp();

		$this->productOne = Product::factory()->make();
		$this->productTwo = Product::factory()->make();

		$this->productCategory = ProductCategory::factory()->create();

		$this->productOne->productCategory()->associate($this->productCategory);
		$this->productOne->save();
		$this->productTwo->productCategory()->associate($this->productCategory);
		$this->productTwo->save();
    }

	public function testIndex()
	{
		$this
			->get(route('products.index'))
			->assertOk()
			->assertJsonCount(2, 'data')
			->assertJsonFragment([
				'data' => [
					[
						"name" => $this->productOne->name,
						"price" => $this->productOne->price,
						"category_id" => $this->productCategory->id,
						"image" => $this->productOne->image,
						"created_at" => $this->productOne->created_at,
						"updated_at" => $this->productOne->updated_at,
					], [
						"name" => $this->productTwo->name,
						"price" => $this->productTwo->price,
						"category_id" => $this->productCategory->id,
						"image" => $this->productTwo->image,
						"created_at" => $this->productTwo->created_at,
						"updated_at" => $this->productTwo->updated_at,
					],
				]
			]);
	}

	public function testShow()
	{
		$productShow = Product::factory()->create([
			'name' => 'Show Example',
			'price' => 35.42,
			'category_id' => $this->productCategory->id,
		]);

		$this
			->get(route('products.show', $productShow))
			->assertOk()
			->assertJsonFragment(['price' => 35.42]);
	}

	public function testStore()
	{
		$base64 = 'iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSB';

		$this
			->post(route('products.store'), [
				'name' => 'Product name',
				'price' => 35.42,
				'category_id' => $this->productCategory->id,
				'image' => $base64
			])
		    ->assertCreated()
			->assertJsonFragment([
				"name" => 'Product name',
				"price" => 35.42,
				"category_id" => $this->productCategory->id,
				"image" => $base64,
			])
			->assertJsonMissing(['id']);
	}

	public function testUpdate()
	{
		$this
			->patch(route('products.update', $this->productOne), [
				'name' => 'Updated name',
				'price' => 777,
			])
			->assertOk()
			->assertJsonFragment([
				"name" => 'Updated name',
				"price" => 777,
			])
			->assertJsonMissing(['id']);
	}

	public function testDestroy()
	{
		$this
			->delete(route('products.destroy', $this->productOne))
			->assertOk()
			->assertJsonMissing(['id']);
	}
}
