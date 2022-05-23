<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'price' => ['numeric'],
            'category_id' => ['int'],
            'image' => ['string'],
        ];
    }
}
