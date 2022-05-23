<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartItemFeatureTest extends TestCase
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

		$this->cartItemOne = CartItem::create(['product_id' => $this->productOne->id]);
		$this->cartItemTwo = CartItem::create(['product_id' => $this->productTwo->id]);
    }

	public function testIndex()
	{
		$this
			->get(route('cart-items.index'))
			->assertOk()
			->assertJsonCount(2, 'data')
			->assertJsonFragment([
				'data' => [
					[
						"product_id" => $this->productOne->id,
						"product_category" => $this->productOne->productCategory->name,
						"created_at" => $this->cartItemOne->created_at,
						"updated_at" => $this->cartItemOne->updated_at,
					],
					[
						"product_id" => $this->productTwo->id,
						"product_category" => $this->productTwo->productCategory->name,
						"created_at" => $this->cartItemTwo->created_at,
						"updated_at" => $this->cartItemTwo->updated_at,
					],
				]
			]);
	}

	public function testShow()
	{
		$this
			->get(route('cart-items.show', $this->cartItemOne))
			->assertOk()
			->assertJsonFragment([
				"product_id" => $this->productOne->id,
				"product_category" => $this->productOne->productCategory->name,
				"created_at" => $this->cartItemOne->created_at,
				"updated_at" => $this->cartItemOne->updated_at,
			]);
	}

	public function testStore()
	{
		$productStore = Product::factory()->make();
		$productCategoryStore = ProductCategory::factory()->create();

		$productStore->productCategory()->associate($productCategoryStore);
		$productStore->save();

		$this
			->post(route('cart-items.store'), [
				'product_id' => $productStore->id,
			])
		    ->assertCreated()
			->assertJsonFragment([
				'product_id' => $productStore->id,
				'product_category' => $productCategoryStore->name,
			])
			->assertJsonMissing(['id']);
	}

	public function testUpdate()
	{
		$productUpdate = Product::factory()->make();
		$productCategoryUpdate = ProductCategory::factory()->create();

		$productUpdate->productCategory()->associate($productCategoryUpdate);
		$productUpdate->save();

		$this
			->patch(route('cart-items.update', $this->cartItemOne), [
				'product_id' => $productUpdate->id,
			])
			->assertOk()
			->assertJsonFragment([
				'product_id' => $productUpdate->id,
			])
			->assertJsonMissing(['id']);
	}

	public function testDestroy()
	{
		$this
			->delete(route('cart-items.destroy', $this->cartItemOne))
			->assertOk()
			->assertJsonMissing(['id']);
	}
}
