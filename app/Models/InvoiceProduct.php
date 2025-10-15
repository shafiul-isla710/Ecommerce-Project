<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'size',
        'color',
    ];

    public function invoice():BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
