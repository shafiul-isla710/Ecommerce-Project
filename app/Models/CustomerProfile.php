<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'mobile_no',
        'city',
        'state',
        'post_code',
        'address',

        'cus_fax',
        'ship_name',
        'ship_add',
        'ship_city',
        'ship_state',
        'ship_postcode',
        'ship_country',
        'ship_phone',
        'ship_fax',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
