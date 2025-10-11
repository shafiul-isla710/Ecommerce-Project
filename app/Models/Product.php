<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function productSlider():HasOne
    {
        return $this->hasOne(ProductSlider::class);
    }

    public function wishList():HasMany
    {
        return $this->hasMany(ProductWishList::class);
    }
    public function productDetails():HasOne
    {
        return $this->hasOne(ProductDetails::class);
    }


}
