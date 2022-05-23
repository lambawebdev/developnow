<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoryFeatureTest extends TestCase
{
	use RefreshDatabase;

	public function setUp(): void
    {
		parent::setUp();

		$this->productCategoryOne = ProductCategory::factory()->create();
		$this->productCategoryTwo = ProductCategory::factory()->create();
	}

	public function testIndex()
	{
		$this
			->get(route('product-categories.index'))
			->assertOk()
			->assertJsonCount(2, 'data')
			->assertJsonFragment([
				'data' => [
					[
						"name" => $this->productCategoryOne->name,
						"created_at" => $this->productCategoryOne->created_at,
						"updated_at" => $this->productCategoryOne->updated_at,
					], [
						"name" => $this->productCategoryTwo->name,
						"created_at" => $this->productCategoryTwo->created_at,
						"updated_at" => $this->productCategoryTwo->updated_at,
					],
				]
			]);
	}

	public function testShow()
	{
		$productCategoryShow = ProductCategory::factory()->create([
			'name' => 'Phones',
		]);

		$this
			->get(route('product-categories.show', $productCategoryShow))
			->assertOk()
			->assertJsonFragment(['name' => $productCategoryShow->name])
			->assertJsonMissing(['id' => $this->productCategoryOne->id])
			->assertJsonMissing(['id' => $this->productCategoryTwo->id]);
	}

	public function testStore()
	{
		$this
			->post(route('product-categories.store'), [
				'name' => 'Laptops',
			])
		    ->assertCreated()
			->assertJsonFragment([
				"name" => 'Laptops',
			])
			->assertJsonMissing(['id']);
	}

	public function testUpdate()
	{
		$this
			->patch(route('product-categories.update', $this->productCategoryOne), [
				'name' => 'Updated category name',
			])
			->assertOk()
			->assertJsonFragment([
				"name" => 'Updated category name',
			])
			->assertJsonMissing(['id']);
	}

	public function testDestroy()
	{
		$this
			->delete(route('product-categories.destroy', $this->productCategoryOne))
			->assertOk()
			->assertJsonMissing(['id']);
	}
}
