<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'content',
        'total_price',
        'total_discount',
        'total_origin_price'
    ];
}
