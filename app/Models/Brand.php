<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name','image'];

    protected $hidden = ['created_at','updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
