<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Product;

class CartItemController extends Controller
{
    public function index()
    {
        return CartItemResource::collection(
			CartItem::with('products.productCategory')->get()
        );
    }

    public function store(CartItemRequest $request)
    {
        $cartItem = CartItem::create($request->validated());

        return new CartItemResource($cartItem);
    }

    public function show(CartItem $cartItem)
    {
        return new CartItemResource($cartItem);
    }

    public function update(CartItemRequest $request, CartItem $cartItem)
    {
		$cartItem->fill($request->validated());
		$cartItem->save();

		$cartItem->refresh();

        return new CartItemResource($cartItem);
    }

    public function destroy(CartItem $cartItem)
    {
		$cartItem->delete();

        return new CartItemResource($cartItem);
    }
}
