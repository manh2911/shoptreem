<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'delivery_time',
        'total_price',
        'total_origin_price',
        'total_discount',
        'status'
    ];
}
