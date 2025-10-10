<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'slug',
        'short_desc',
        'price',
        'discount_type',
        'discount',
        'discount_price',
        'stock',
        'image',
        'star',
        'remarks',
        'category_id',
        'brand_id'
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function slider()
    {
        return $this->hasMany(ProductSlider::class);
    }

}
