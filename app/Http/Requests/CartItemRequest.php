<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => ['required', 'int'],
        ];
    }
}
