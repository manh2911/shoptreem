<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageDetailProduct extends Model
{
    protected $table = 'image_detail_products';

    protected $fillable = [
        'image',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
