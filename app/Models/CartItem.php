<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CartItem extends Model
{
	protected $fillable = [
        'product_id',
    ];

    protected $hidden = [
        'id',
    ];

    public function products(): HasMany
	{
		return $this->hasMany('App\Models\Product', 'id');
	}
}
