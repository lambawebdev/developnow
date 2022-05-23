<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use HasFactory, SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = [
        'name',
        'price',
        'category_id',
        'image',
    ];

    protected $hidden = [
        'id',
    ];

	public function getPriceAttribute()
	{
		return $this->attributes['price'] /100;
	}

	public function setPriceAttribute($value)
	{
		$this->attributes['price'] = $value * 100;
	}

	public function productCategory(): BelongsTo
	{
		return $this->belongsTo('App\Models\ProductCategory', 'category_id');
	}

	public function cartItem(): BelongsTo
	{
		return $this->belongsTo('App\Models\CartItem');
	}
}
