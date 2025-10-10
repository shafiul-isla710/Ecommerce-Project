<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSlider extends Model
{
    protected $fillable = [
        'product_id',
        'title',
        'short_desc',
        'price',
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
